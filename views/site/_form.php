<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?php
$form = ActiveForm::begin();//<form>
    echo $form->field($userModel, "username");//<input type="text" name="user">
    echo $form->field($userModel, "password_hash")->passwordInput();
    echo $form->field($userModel, "email");
    echo $form->field($userModel, "status")->checkbox();
    echo Html::submitInput(($userModel->isNewRecord) ? 'ایجاد':'ویرایش',[
        'class'=> ($userModel->isNewRecord) ?'btn btn-sm btn-success':'btn btn-sm btn-primary'
    ]);

ActiveForm::end();//</form>
