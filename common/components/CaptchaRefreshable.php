<?php
namespace common\components;

/**
 * Checks if authorID matches user passed via params
 */
class CaptchaRefreshable extends \yii\captcha\Captcha
{
    /**
     * Overrides the $template HTML
     */
    public function init()
    {
        $refresh_a = \yii\helpers\Html::a('refresh', '#', [
            'id' => 'refresh-captcha',
            'class' => 'text-small' // .text-small { font-size: 0.85em; } - include in your CSS
        ]);
  
        $this->template = '
            <div id="verify-code" class="row">
            <div class="large-3 columns">{image} ' . $refresh_a . '</div>
            <div class="large-6 columns">{input}</div>
            </div>';
        parent::init();
    }
  
    /** 
     * Register the refresh JS 
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        $view->registerJs(" $('#refresh-captcha').on('click', function(e){ e.preventDefault(); $('#verify-code img').yiiCaptcha('refresh'); }) ");
        parent::registerClientScript();
    }
}