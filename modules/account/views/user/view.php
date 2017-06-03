<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $userModel common\models\User */

$this->title = $userModel->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?>

    <div class="pull-right">
        <?= Html::a(Yii::t('app', 'Close'), ['index'], ['class' => 'btn btn-warning', 'data-pjax' => '0', 'data-dismiss' => 'modal']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $userModel->id], [
            'class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $userModel->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

    </h1>

    <?= DetailView::widget([
        'model' => $userModel,
        'attributes' => [
            'id',
            'username',
            'email:email',
            //'password_hash',
            [
                'attribute'=>'status',
//                'value' => $userModel->getStatusName(),
            ],
            [
                'attribute'=>'item_name',
                'value' => $userModel->getRoleName(),
            ],
            //'auth_key',
            //'password_reset_token',
            //'account_activation_token',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
