<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($priceTimeModel, "price"); ?>
    <?= $form->field($priceTimeModel, "time"); ?>
    <?= $form->field($priceTimeModel, "card_type")->dropDownList($gameTypeItems, [
        'prompt' => '--select-item--'
    ]); ?>
    <?= $form->field($priceTimeModel, "game_type")->dropDownList($cardTypeItems, [
        'prompt' => '--select-item--'
    ]); ?>
    <?= $form->field($priceTimeModel, "status")->checkbox(); ?>
    <?= Html::submitInput('اضافه کردن', [
        'class' => 'btn btn-sm btn-success'
    ]) ?>
<?php ActiveForm::end(); ?>