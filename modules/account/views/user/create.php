<?php
use yii\helpers\Html;
use app\widgets\BoxHtml;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'User');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'userModel' => $userModel,
    'roleModel' => $roleModel,
    'auth_items' => $auth_items,
]); ?>