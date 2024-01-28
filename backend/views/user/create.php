<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\v1\User */

?>
<div class="user-create">
    <?= $this->render('_form', [
        'model' => $model,
        //'signup_form' => $signup_form,
        'profiles' => $profiles
    ]) ?>
</div>
