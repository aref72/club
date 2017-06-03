<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;
?>
<?php $form = ActiveForm::begin([
    'id' => 'user-form',
    'options' => [
        'data-pjax' => 1
    ]
]); ?>

    <?= $form->field($userModel, "username"); ?>
    
    <?= $form->field($userModel, "password_hash")->passwordInput(); ?>
    
    <?= $form->field($userModel, "email")->input('email'); ?>
    
    <?php $userModel->status = 1; ?>
    <?= $form->field($userModel, "status")->widget(SwitchInput::className()); ?>

    <?= $form->field($roleModel, "item_name")->dropDownList($auth_items, ['prompt' => '-- select item--']); ?>

    <?= Html::submitButton(($userModel->isNewRecord) ? '<i class="fa fa-send"></i> '.Yii::t('app', 'create') : '<i class="fa fa-send"></i> '.Yii::t('app', 'update'), ['class' => ($userModel->isNewRecord) ? 'btn btn-sm btn-success': 'btn btn-sm btn-primary']); ?>
<?php ActiveForm::end(); ?>