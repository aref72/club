<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
use aki\imageslider\ImageSlider;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" style="margin-top:100px;">
    <div class="col-lg-4 col-md-4 col-sm-4  col-sm-offset-4">
        <div class="panel panel-default animated bounceIn" style="border:0px;border-radius:10px;">
            <div class="panel-heading" style="padding:0px;border-radius:10px;">
            <?= ImageSlider::widget([
                'baseUrl' => Yii::getAlias('@web/images'),
                'nextPerv' => false,
                'indicators' => false,
                'height' => '170px',
                'classes' => 'img-rounded',
                'images' => [
                    [
                        'active' => true,
                        'src' => 'a.jpg',
                        'title' => 'image',

                    ],
                    [
                        'src' => 'd.jpg',
                        'title' => 'image',
                    ],
                    [
                        'src' => 'b.jpg',
                        'title' => 'image',
                    ],
                    [
                        'src' => 'c.jpg',
                        'title' => 'image',
                    ],
                ],
            ]);?>
            </div>
            <div class="panel-body">
            <hr/>
            <p><?= Yii::t('app', 'Please fill out the following fields to login:') ?></p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?php //-- use email or username field depending on model scenario --// ?>
            <?php if ($model->scenario === 'lwe'): ?>
                <?= $form->field($model, 'email') ?>        
            <?php else: ?>
                <?= $form->field($model, 'username') ?>
            <?php endif ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div style="color:#999;margin:1em 0">
                <?= Yii::t('app', 'If you forgot your password you can') ?>
                <?= Html::a(Yii::t('app', 'reset it'), ['site/request-password-reset']) ?>.
            </div>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

