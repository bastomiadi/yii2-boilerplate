<?php

namespace common\models\v1;

use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%offers}}".
 *
 * @property int $id
 * @property string $letter_code
 * @property string $to
 * @property string $regarding
 * @property string $description
 * @property string $content
 * @property int $officer
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
 * @property Officer $officer0
 * @property User $updatedBy
 */
class Offers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%offers}}';
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
            'mdm\autonumber\Behavior' => 
            [
                'class' => 'mdm\autonumber\Behavior',
                'attribute' => 'letter_code', // required
                // 'group' => $this->id_branch, // optional
                'value' => function () {
                    $model = $this->romawi;
                    return '?' . '/MRKT/RSGH/' . $model . '/' . date('Y'); // Example format for auto number
                },
                'digit' => 4 // optional, default to null. 
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['to', 'regarding', 'description', 'content', 'officer'], 'required'],
            [['content'], 'string'],
            [['officer', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'], 'integer'],
            [['letter_code', 'to', 'regarding', 'description'], 'string', 'max' => 255],
            [['officer'], 'exist', 'skipOnError' => true, 'targetClass' => Officer::class, 'targetAttribute' => ['officer' => 'id']],
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
            'letter_code' => 'Letter Code',
            'to' => 'To',
            'regarding' => 'Regarding',
            'description' => 'Description',
            'content' => 'Content',
            'officer' => 'Officer',
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
     * Gets query for [[Officer0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfficer0()
    {
        return $this->hasOne(Officer::class, ['id' => 'officer']);
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

    public static function getRomawi(){ 
        $n = intval(date('m')); 
        $hasil = ''; 
     
        $nomor_romawi = array( 
            'M'  => 1000, 
            'CM' => 900, 
            'D'  => 500, 
            'CD' => 400, 
            'C'  => 100, 
            'XC' => 90, 
            'L'  => 50, 
            'XL' => 40, 
            'X'  => 10, 
            'IX' => 9, 
            'V'  => 5, 
            'IV' => 4, 
            'I'  => 1); 
    
        foreach ($nomor_romawi as $romawi => $nom){ 
            $cocok = intval($n / $nom); 
            $hasil .= str_repeat($romawi, $cocok); 
            $n = $n % $nom; 
        } 
     
        return $hasil; 
    } 
    
}
