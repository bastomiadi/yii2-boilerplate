<?php
namespace common\components;

use Yii;

/**
 * Checks if authorID matches user passed via params
 */
class CaptchaRefreshableAction extends \yii\captcha\CaptchaAction
{
    public function validate($input, $caseSensitive)
    {
        // Skip validation on AJAX requests, as it expires the captcha.
        if (Yii::$app->request->isAjax) {
            return true;
        }

        // print_r($input);
        // die;
        return parent::validate($input, $caseSensitive);
    }
  
}