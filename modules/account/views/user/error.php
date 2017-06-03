<?php
use app\components\ImageSlider;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="row" style="margin-top:30px;">
<div class="col-lg-4 col-md-4 col-sm-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-3">
<div class="panel panel-default" style="border:0px;border-radius:10px;">
    <div class="panel-heading" style="padding:0px;border-radius:10px;">
    <?= ImageSlider::widget([
            'nextPerv' => false,
            'indicators' => false,
            'height' => '170px',
            'classes' => 'img-rounded',
            'images' => [
                [
                    'active' => true,
                    'src' => 'image/a.jpg',
                    'title' => 'image',
                    
                ],
                [
                    'src' => 'image/b.jpg',
                    'title' => 'image',
                ]
            ],
    ]);?>
    </div>
    <div class="panel-body">
    <hr/>
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="alert alert-danger">
            <?= nl2br(Html::encode($message)) ?>
        </div>

        <p>
            The above error occurred while the Web server was processing your request.
        </p>
        <p>
            Please contact us if you think this is a server error. Thank you.
        </p><br>
    </div>
</div>
</div>
</div>

