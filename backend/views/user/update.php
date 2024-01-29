<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\v1\User */
?>
<div class="user-update">

    <?= $this->render('_form', [
         'model' => $model,
         'profiles' => $profiles,
         'auth_assignment' => $auth_assignment
    ]) ?>

</div>
