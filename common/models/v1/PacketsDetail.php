<?php

namespace common\models\v1;

use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%packets_detail}}".
 *
 * @property int $id
 * @property int $packet
 * @property int $id_product_rsgh
 * @property string $name_product_rsgh
 * @property int $normal_price
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $isDeleted
 *
 * @property User $createdBy
 * @property User $deletedBy
 * @property Packet $packet0
 * @property ProductsRsgh $productRsgh
 * @property User $updatedBy
 */
class PacketsDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%packets_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'blameable' => BlameableBehavior::class,
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'isDeleted' => true,
                    'deleted_at' => new Expression('unix_timestamp(NOW())'),
                    'deleted_by' => Yii::$app->user->identity->id ?? $this->deletedBy
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_product_rsgh', 'normal_price', 'custom_price'], 'required'],
            [['packet', 'id_product_rsgh', 'normal_price', 'custom_price', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'], 'integer'],
            [['name_product_rsgh'], 'string', 'max' => 255],
            [['packet'], 'exist', 'skipOnError' => true, 'targetClass' => Packet::class, 'targetAttribute' => ['packet' => 'id']],
            [['id_product_rsgh'], 'exist', 'skipOnError' => true, 'targetClass' => ProductsRsgh::class, 'targetAttribute' => ['id_product_rsgh' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['deleted_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'packet' => 'Packet',
            'id_product_rsgh' => 'Id Product Rsgh',
            'name_product_rsgh' => 'Name Product Rsgh',
            'normal_price' => 'Normal Price',
            'custom_price' => 'Custom Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
            'isDeleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[DeletedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::class, ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[Packet0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPacket0()
    {
        return $this->hasOne(Packet::class, ['id' => 'packet']);
    }

    /**
     * Gets query for [[ProductRsgh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductRsgh()
    {
        return $this->hasOne(ProductsRsgh::class, ['id' => 'id_product_rsgh']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
