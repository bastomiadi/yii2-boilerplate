<?php

namespace common\models\v1;

use Yii;

/**
 * This is the model class for table "{{%audit_entry}}".
 *
 * @property int $audit_entry_id
 * @property string $audit_entry_timestamp
 * @property string $audit_entry_model_name
 * @property string $audit_entry_operation
 * @property string|null $audit_entry_field_name
 * @property string|null $audit_entry_old_value
 * @property string|null $audit_entry_new_value
 * @property string|null $audit_entry_user_id
 * @property string|null $audit_entry_ip
 */
class AuditEntry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%audit_entry}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['audit_entry_timestamp', 'audit_entry_model_name', 'audit_entry_operation'], 'required'],
            [['audit_entry_old_value', 'audit_entry_new_value'], 'string'],
            [['audit_entry_timestamp', 'audit_entry_model_name', 'audit_entry_operation', 'audit_entry_field_name', 'audit_entry_user_id', 'audit_entry_ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'audit_entry_id' => Yii::t('app', 'Audit Entry ID'),
            'audit_entry_timestamp' => Yii::t('app', 'Audit Entry Timestamp'),
            'audit_entry_model_name' => Yii::t('app', 'Audit Entry Model Name'),
            'audit_entry_operation' => Yii::t('app', 'Audit Entry Operation'),
            'audit_entry_field_name' => Yii::t('app', 'Audit Entry Field Name'),
            'audit_entry_old_value' => Yii::t('app', 'Audit Entry Old Value'),
            'audit_entry_new_value' => Yii::t('app', 'Audit Entry New Value'),
            'audit_entry_user_id' => Yii::t('app', 'Audit Entry User ID'),
            'audit_entry_ip' => Yii::t('app', 'Audit Entry Ip'),
        ];
    }
}
