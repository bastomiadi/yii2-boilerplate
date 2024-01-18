<?php

namespace common\models\v1;

use Yii;

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
    public function rules()
    {
        return [
            [['user', 'first_name', 'gender', 'marital', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['user', 'gender', 'marital', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'], 'integer'],
            [['address'], 'string'],
            [['date_of_birth'], 'safe'],
            [['first_name', 'last_name', 'profile_image'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 20],
            [['user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user' => 'id']],
            [['gender'], 'exist', 'skipOnError' => true, 'targetClass' => Genders::class, 'targetAttribute' => ['gender' => 'id']],
            [['marital'], 'exist', 'skipOnError' => true, 'targetClass' => Marital::class, 'targetAttribute' => ['marital' => 'id']],
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
