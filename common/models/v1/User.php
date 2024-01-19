<?php

namespace common\models\v1;

use common\models\User as ModelsUser;
use mdm\admin\models\AuthItem;
use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property AuthAssignment[] $authAssignments
 * @property Class[] $classes
 * @property Class[] $classes0
 * @property Class[] $classes1
 * @property AuthItem[] $itemNames
 * @property Section[] $sections
 * @property Section[] $sections0
 * @property Section[] $sections1
 * @property Student[] $students
 * @property Student[] $students0
 * @property Student[] $students1
 */
class User extends ModelsUser
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
        ];
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    // public function getAuthAssignments()
    // {
    //     return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    // }

    /**
     * Gets query for [[Classes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClasses()
    {
        return $this->hasMany(Classes::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Classes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClasses0()
    {
        return $this->hasMany(Classes::class, ['deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Classes1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClasses1()
    {
        return $this->hasMany(Classes::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[ItemNames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::class, ['name' => 'item_name'])->viaTable('{{%auth_assignment}}', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Sections]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Sections::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Sections0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSections0()
    {
        return $this->hasMany(Sections::class, ['deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Sections1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSections1()
    {
        return $this->hasMany(Sections::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Students]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Students0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents0()
    {
        return $this->hasMany(Students::class, ['deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Students1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudents1()
    {
        return $this->hasMany(Students::class, ['updated_by' => 'id']);
    }
}