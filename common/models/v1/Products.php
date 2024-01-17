<?php

namespace common\models\v1;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $product_name
 * @property int|null $category_id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $deleted_by
 *
 * @property Category $category
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
            'category' => fn() => $this->category->category_name,
            'created_by' => fn () => $this->createdBy->username ?? null,
            'updated_by' => fn () => $this->updatedBy->username ?? null,
            'deleted_by' => fn () => $this->deletedBy->username ?? null,
            'created_at' => fn () => $this->created_at ? \Yii::$app->formatter->asDate($this->created_at, 'long') : null,
            'updated_at' => fn () => $this->updated_at ? \Yii::$app->formatter->asDate($this->updated_at, 'long') : null,
            'deleted_at' => fn () => $this->deleted_at ? \Yii::$app->formatter->asDate($this->deleted_at, 'long') : null,
            'isDeleted'
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
    public function rules()
    {
        return [
            [['product_name', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['category_id', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['product_name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'id' => Yii::t('app', 'ID'),
            'product_name' => Yii::t('app', 'Product Name'),
            'category_id' => Yii::t('app', 'Category ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'category_id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
