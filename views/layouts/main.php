<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="rtl">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap" id="game-body">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'id' => 'menu',
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [ 
            Yii::$app->user->isGuest ? (
                ['label' => 'ورود', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'خروج (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
            ['label' => 'درباره ما', 'url' => ['/site/about']],
            (Yii::$app->user->identity->level == 1) ? ['label' => 'لیست مبالغ تعیین شده', 'url' => ['/price-time/list']]: '',
            (Yii::$app->user->identity->level == 1) ? ['label' => 'کارت ها', 'url' => ['/card/list']]: '',
            (Yii::$app->user->identity->level == 1) ? ['label' => 'کاربرها', 'url' => ['/user/list']]: '',
            ['label' => 'گزارشات',  
                'url' => ['#'],
//                'template' => '<a href="{url}" >{label}<i class="fa fa-angle-left pull-right"></i></a>',
                'items' => [
                    ['label' => 'گزارش کل', 'url' => ['/game/list'], 'options' => ['class' => 'text-right']],
                ],
                
            ],
            ['label' => 'خانه', 'url' => ['/game/create']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>
<?php
$css="
       #game-body
   {
        background:url('images/blue.jpg');
        background-size: cover;
   }
    ";
$this->registerCss($css);
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
