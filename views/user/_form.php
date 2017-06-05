<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php
$form= ActiveForm::begin()
?>
<?= $form->field($userModel,'username') ?>
<?= $form->field($userModel,'password_hash')->passwordInput() ?>
<?= $form->field($userModel,'email') ?>
<?= $form->field($userModel,'status')->checkbox() ?>
 
<?= Html::submitButton('ایجاد', ['class' => 'btn btn-sm btn-primary']) ?>
   
<?php ActiveForm::end();
?>