<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php
$form= ActiveForm::begin()
?>
<?= $form->field($cardModel,'card_number') ?>
<?= $form->field($cardModel, "card_type")->dropDownList($CardTypeItem);?>

<?= $form->field($cardModel,'status')->checkbox() ?>
 
<?= Html::submitButton(($cardModel->isNewRecord) ? 'ایجاد':'ویرایش', ['class' => 'btn btn-sm btn-primary']) ?>
   
<?php ActiveForm::end();
?>