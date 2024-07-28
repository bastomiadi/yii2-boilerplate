<?php
namespace common\components;

use Yii;
use yii\db\Expression;

class DateHelper
{
    public static function getUnixTimestampExpression()
    {
        $db = Yii::$app->db;

        if ($db->driverName === 'pgsql') {
            return new Expression('EXTRACT(EPOCH FROM NOW())');
        } else {
            return new Expression('UNIX_TIMESTAMP(NOW())');
        }
    }
}
