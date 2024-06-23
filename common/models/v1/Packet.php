<?php

namespace common\models\v1;

use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%packets}}".
 *
 * @property int $id
 * @property string $packet_name
 * @property int $total_price
 * @property string|null $description
 * @property int $discount_percent
 * @property int $discount_rupiah
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
 * @property PacketsDetail[] $packetsDetails
 * @property User $updatedBy
 */
class Packet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%packets}}';
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
            [['packet_name', 'total_price', 'discount_percent', 'discount_rupiah'], 'required'],
            [['total_price', 'discount_percent', 'discount_rupiah', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'], 'integer'],
            [['description'], 'string'],
            [['packet_name'], 'string', 'max' => 255],
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
            'packet_name' => 'Packet Name',
            'total_price' => 'Total Price',
            'description' => 'Description',
            'discount_percent' => 'Discount Percent',
            'discount_rupiah' => 'Discount Rupiah',
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
     * Gets query for [[PacketsDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPacketsDetails()
    {
        return $this->hasMany(PacketsDetail::class, ['packet' => 'id']);
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
