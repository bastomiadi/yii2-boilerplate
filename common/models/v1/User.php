<?php

namespace common\models\v1;

use mdm\admin\models\AuthItem;
use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use Yii;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\ForbiddenHttpException;
use yii\web\IdentityInterface;

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
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int|null $deleted_at
 * @property string|null $verification_token
 *
 * @property AuthAssignment[] $authAssignments
 * @property Category[] $categories
 * @property Category[] $categories0
 * @property Category[] $categories1
 * @property Class[] $classes
 * @property Class[] $classes0
 * @property Class[] $classes1
 * @property User $createdBy
 * @property User $deletedBy
 * @property Gender[] $genders
 * @property Gender[] $genders0
 * @property Gender[] $genders1
 * @property AuthItem[] $itemNames
 * @property Marital[] $maritals
 * @property Marital[] $maritals0
 * @property Marital[] $maritals1
 * @property Product[] $products
 * @property Product[] $products0
 * @property Product[] $products1
 * @property Profile[] $profiles
 * @property Profile[] $profiles0
 * @property Profile[] $profiles1
 * @property Profile[] $profiles2
 * @property Section[] $sections
 * @property Section[] $sections0
 * @property Section[] $sections1
 * @property Student[] $students
 * @property Student[] $students0
 * @property Student[] $students1
 * @property User $updatedBy
 * @property User[] $users
 * @property User[] $users0
 * @property User[] $users1
 */
class User extends ActiveRecord implements IdentityInterface {

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_SIGNUP = 'signup';

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $password;
    public $password_repeat;
    public $hash;

    // for rest api field showing
    public function fields()
    {
        return [
           'id',
           'username',
           'email',
           'profiles' => fn () => $this->profiles,
        ];
    }

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
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'status' => self::STATUS_DELETED,
                    'deleted_at' => new Expression('NOW()'),
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
     * @inheritdoc
     */
    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_LOGIN] = ['username', 'password'];
        $scenarios[self::SCENARIO_CREATE] = ['username', 'password', 'password_repeat', 'email', 'auth_key', 'status'];
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'password', 'password_repeat', 'email', 'status'];
        $scenarios[self::SCENARIO_SIGNUP] = ['username', 'password', 'password_repeat', 'email', 'auth_key', 'status', 'verification_token'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by', 'deleted_by', 'deleted_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'password_repeat'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['password_reset_token'], 'unique'],
            ['username', 'trim'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_SIGNUP]],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_SIGNUP]],

            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['deleted_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],

            [
                'username',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => Yii::t('app', 'This username has already been taken by another user.'),
                'when' => function ($model){
                    return $model->isAttributeChanged('username');
                },
                'on' => self::SCENARIO_UPDATE
            ],
            [
                'email',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => Yii::t('app','This email address has already been taken by another user.'),
                'when' => function ($model){
                    return $model->isAttributeChanged('email');
                },
                'on' => self::SCENARIO_UPDATE
            ],

            [['username', 'password'], 'required', 'on' => self::SCENARIO_LOGIN],
            [['username', 'password', 'password_repeat', 'email', 'status'], 'required', 'on' => self::SCENARIO_CREATE],
            [['username', 'email', 'status'], 'required', 'on' => self::SCENARIO_UPDATE],

            // Generate a random String with 32 characters to use as AuthKey
            [['auth_key'], 'default', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_SIGNUP], 'value' => $this->generateAuthKey()],
            [['password'], 'compare', 'on' => [self::SCENARIO_CREATE, self::SCENARIO_UPDATE, self::SCENARIO_SIGNUP], 'skipOnEmpty' => true],

            [['status'], 'default', 'on'=> [self::SCENARIO_SIGNUP, self::SCENARIO_CREATE], 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],

            [['verification_token'], 'default', 'on' => self::SCENARIO_SIGNUP, 'value' => $this->generateEmailVerificationToken()],

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
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        if(strlen($this->password) > 0) {
            $this->setPassword($this->password);
        }
        return parent::beforeSave($insert);

        // if (parent::beforeSave($insert)) {
        //     if($insert) {
        //         $this->setPassword($this->password);
        //     }
        //     else {
        //         if(strlen($this->password) > 0) {
        //             $this->setPassword($this->password);
        //         }
        //         else {
        //             $this->password_hash = $this->hash;
        //         }
        //     }
        //     return true;
        // }
        // return false;
    }

     /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    //jwt token
    public static function findIdentityByAccessToken($token, $type = null)
    {

        $claims = \Yii::$app->jwt->parse($token)->claims();
        $uid = $claims->get('uid');

        if (!is_numeric($uid)) {
            throw new ForbiddenHttpException('Invalid token provided');
        }

        return static::findOne(['id' => $uid, 'status' => self::STATUS_ACTIVE]);

    }

    //ini untuk menggenerate token JWT nya ketika misal pertama kali login
    public static function generateToken($id){
        $now = new \DateTimeImmutable('now', new \DateTimeZone(\Yii::$app->timeZone));
        $token = \Yii::$app->jwt->getBuilder()
         // Configures the issuer (iss claim)
            ->issuedBy('http://example.com')
            // Configures the audience (aud claim)
            ->permittedFor('http://example.org')
            // Configures the id (jti claim)
            ->identifiedBy('4f1g23a12aa')
            // Configures the time that the token was issued
            ->issuedAt($now)
            // Configures the time that the token can be used
            ->canOnlyBeUsedAfter($now)
            //->canOnlyBeUsedAfter($now->modify('+1 minute'))
            // Configures the expiration time of the token
            ->expiresAt($now->modify('+60 minutes'))
            // Configures a new claim, called "uid", with user ID, assuming $user is the authenticated user object
            ->withClaim('uid', $id)
            // Builds a new token
            ->getToken(
                \Yii::$app->jwt->getConfiguration()->signer(),
                \Yii::$app->jwt->getConfiguration()->signingKey()
            );
        return (string) $token->toString();
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    public function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Categories0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories0()
    {
        return $this->hasMany(Categories::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Categories1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories1()
    {
        return $this->hasMany(Categories::class, ['deleted_by' => 'id']);
    }

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
     * Gets query for [[Genders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenders()
    {
        return $this->hasMany(Genders::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Genders0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenders0()
    {
        return $this->hasMany(Genders::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Genders1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenders1()
    {
        return $this->hasMany(Genders::class, ['deleted_by' => 'id']);
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
     * Gets query for [[Maritals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaritals()
    {
        return $this->hasMany(Marital::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Maritals0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaritals0()
    {
        return $this->hasMany(Marital::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Maritals1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaritals1()
    {
        return $this->hasMany(Marital::class, ['deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Products::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Products1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts1()
    {
        return $this->hasMany(Products::class, ['deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profiles::class, ['user' => 'id']);
    }

    /**
     * Gets query for [[Profiles0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles0()
    {
        return $this->hasMany(Profiles::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Profiles1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles1()
    {
        return $this->hasMany(Profiles::class, ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Profiles2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles2()
    {
        return $this->hasMany(Profiles::class, ['deleted_by' => 'id']);
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
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Users0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::class, ['deleted_by' => 'id']);
    }

    /**
     * Gets query for [[Users1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers1()
    {
        return $this->hasMany(User::class, ['updated_by' => 'id']);
    }

}
