<?php

namespace common\models\v1;

use common\models\User;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%students}}".
 *
 * @property int $id
 * @property int $sections
 * @property int $classes
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $phone_number
 * @property int $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $isDeleted
 *
 * @property Class $classes0
 * @property User $createdBy
 * @property User $deletedBy
 * @property Section $sections0
 * @property User $updatedBy
 */
class Students extends \yii\db\ActiveRecord
{

     // for rest api field showing
     public function fields()
     {
         return [
            'id',
            'name',
            'sections' => fn() => $this->sections0->name,
            'classes' => fn() => $this->classes0->name,
            'created_by' => fn () => $this->createdBy->username ?? $this->createdBy,
            'updated_by' => fn () => $this->updatedBy->username ?? $this->updatedBy,
            'deleted_by' => fn () => $this->deletedBy->username ?? $this->deletedBy,
            'created_at' => fn () => $this->created_at ? \Yii::$app->formatter->asDatetime($this->created_at, 'long') : null,
            'updated_at' => fn () => $this->updated_at ? \Yii::$app->formatter->asDatetime($this->updated_at, 'long') : null,
            'deleted_at' => fn () => $this->deleted_at ? \Yii::$app->formatter->asDatetime($this->deleted_at, 'long') : null,
            'isDeleted'
         ];
     }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%students}}';
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
                    'deleted_at' => time(),
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
            [['sections', 'classes', 'name', 'email', 'address', 'phone_number'], 'required'],
            [['sections', 'classes', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'], 'integer'],
            [['address'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 20],
            [['classes'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::class, 'targetAttribute' => ['classes' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['deleted_by' => 'id']],
            [['sections'], 'exist', 'skipOnError' => true, 'targetClass' => Sections::class, 'targetAttribute' => ['sections' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sections' => Yii::t('app', 'Sections'),
            'classes' => Yii::t('app', 'Classes'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[Classes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClasses0()
    {
        return $this->hasOne(Classes::class, ['id' => 'classes']);
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
     * Gets query for [[Sections0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSections0()
    {
        return $this->hasOne(Sections::class, ['id' => 'sections']);
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
