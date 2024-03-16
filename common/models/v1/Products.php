<?php

namespace common\models\v1;

use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $product_name
 * @property int $category
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $deleted_by
 * @property int|null $isDeleted
 *
 * @property Category $category0
 * @property User $createdBy
 * @property User $deletedBy
 * @property User $updatedBy
 */
class Products extends \yii\db\ActiveRecord
{

    // for rest api field showing
    public function fields()
    {
        return [
            'id',
            'product_name',
            'created_by' => fn () => $this->category0->category_name ?? $this->category0,
            'created_by' => fn () => $this->createdBy->username ?? $this->createdBy,
            'updated_by' => fn () => $this->updatedBy->username ?? $this->updatedBy,
            'deleted_by' => fn () => $this->deletedBy->username ?? $this->deletedBy,
            'created_at' => fn () => $this->created_at ? \Yii::$app->formatter->asDatetime($this->created_at, 'long') : null,
            'updated_at' => fn () => $this->updated_at ? \Yii::$app->formatter->asDatetime($this->updated_at, 'long') : null,
            'deleted_at' => fn () => $this->deleted_at ? \Yii::$app->formatter->asDatetime($this->deleted_at, 'long') : null,
            'isDeleted',
            'restored_by' => fn () => $this->restoredBy->username ?? $this->restoredBy,
            'restored_at' => fn () => $this->restored_at ? \Yii::$app->formatter->asDatetime($this->restored_at, 'long') : null,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

     /**
     * {@inheritdoc}
     */
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
                'restoreAttributeValues' => [
                    'isDeleted' => false,
                    'deleted_at' => NULL,
                    'deleted_by' => NULL,
                    'restored_by' =>  Yii::$app->user->identity->id ?? $this->restoredBy,
                    'restored_at' => new Expression('unix_timestamp(NOW())'),
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
            [['product_name', 'category'], 'required'],
            [['category', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted', 'restored_by', 'restored_at'], 'integer'],
            [['product_name'], 'string', 'max' => 255],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['deleted_by' => 'id']],
            [['restored_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['restored_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_name' => Yii::t('app', 'Product Name'),
            'category' => Yii::t('app', 'Category'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
            'restored_by' => Yii::t('app', 'Restored By'),
            'restored_at' => Yii::t('app', 'Restored At'),
        ];
    }

    /**
     * Gets query for [[Category0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Categories::class, ['id' => 'category']);
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
     * Gets query for [[RestoredBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestoredBy()
    {
        return $this->hasOne(User::class, ['id' => 'restored_by']);
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
