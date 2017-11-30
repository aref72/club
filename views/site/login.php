<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" style="margin-top: 100px;">
    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <!--<p>Please fill out the following fields to login:</p>-->
    <div class=" col-lg-4 col-md-4 col-lg-offset-4">
    <div class="panel panel-info animated bounceIn">
        
        <div class="panel-heading"><span class="glyphicon glyphicon-log-in"></span> ورود به بخش مدیریت</div>
        <div class="panel-body">
            

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 \">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('ورود', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
        </div>
</div>
   <?php
$css="
    #login-body{
    background:url('images/login_back.jpg');
    background-size:cover;
}
    ";
$this->registerCss($css);
?>