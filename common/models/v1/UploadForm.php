<?php
namespace common\models\v1;

use yii\base\Model;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            [['file'], 'required'],
            [['file'], 'file', 'extensions' => 'xlsx', 'maxSize' => 1024 * 1024 * 5],
        ];
    }
}