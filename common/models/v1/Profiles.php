<?php

namespace common\models\v1;

use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%profiles}}".
 *
 * @property int $id
 * @property int $user
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $phone_number
 * @property string|null $address
 * @property int $gender
 * @property int $marital
 * @property string|null $profile_image
 * @property string|null $date_of_birth
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $deleted_by
 * @property int|null $isDeleted
 *
 * @property Gender $gender0
 * @property Marital $marital0
 * @property User $user0
 */
class Profiles extends \yii\db\ActiveRecord
{

    public $file;
     
    // for rest api field showing
    public function fields()
    {
        return [
            'id',
            'user' => fn () => $this->user0->username ?? $this->user0,
            'first_name', 
            'gender' => fn () => $this->gender0->gender_name ?? $this->gender0,
            'marital' => fn () => $this->marital0->marital_name ?? $this->marital0,
            'created_by' => fn () => $this->createdBy->username ?? $this->createdBy,
            'updated_by' => fn () => $this->updatedBy->username ?? $this->createdBy,
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
        return '{{%profiles}}';
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
            [['user', 'first_name', 'gender', 'marital'], 'required'],
            [['user', 'gender', 'marital', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'], 'integer'],
            [['address'], 'string'],
            [['date_of_birth'], 'safe'],
            [['first_name', 'last_name', 'profile_image'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 20],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user' => 'id']],
            [['gender'], 'exist', 'skipOnError' => true, 'targetClass' => Genders::class, 'targetAttribute' => ['gender' => 'id']],
            [['marital'], 'exist', 'skipOnError' => true, 'targetClass' => Marital::class, 'targetAttribute' => ['marital' => 'id']],
            [['file'], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user' => Yii::t('app', 'User'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'address' => Yii::t('app', 'Address'),
            'gender' => Yii::t('app', 'Gender'),
            'marital' => Yii::t('app', 'Marital'),
            'profile_image' => Yii::t('app', 'Profile Image'),
            'date_of_birth' => Yii::t('app', 'Date Of Birth'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'isDeleted' => Yii::t('app', 'Is Deleted'),
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
     * Gets query for [[Gender0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGender0()
    {
        return $this->hasOne(Genders::class, ['id' => 'gender']);
    }

    /**
     * Gets query for [[Marital0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarital0()
    {
        return $this->hasOne(Marital::class, ['id' => 'marital']);
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

    /**
     * Gets query for [[User0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::class, ['id' => 'user']);
    }

    public static function getProfileName(){
        $data = static::findOne(['user' => Yii::$app->user->identity->id]);
        return $data->first_name . ' ' . $data->last_name;
    }

    public static function getProfileImage(){
        $data = static::findOne(['user' => Yii::$app->user->identity->id]);
        return $data->profile_image;
    }
}
