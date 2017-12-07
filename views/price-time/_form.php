<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($priceTimeModel, "price"); ?>
    <?= $form->field($priceTimeModel, "time"); ?>
    <?= $form->field($priceTimeModel, "card_type")->dropDownList($cardTypeItems, [
        'prompt' => '--select-item--'
    ]); ?>
    <?= $form->field($priceTimeModel, "game_type")->dropDownList($gameTypeItems, [
        'prompt' => '--select-item--'
    ]); ?>
    <?= $form->field($priceTimeModel, "status")->checkbox(); ?>
    <?= Html::submitInput('اضافه کردن', [
        'class' => 'btn btn-sm btn-success'
    ]) ?>
 <?= yii\helpers\Html::a('برگشت <i class="glyphicon glyphicon-arrow-left"></i>', yii\helpers\Url::to(['list']), [
        'class' => 'btn btn-sm btn-primary',
        'style' => 'margin-right:10px;'
    ]); ?> 
<?php ActiveForm::end(); ?>