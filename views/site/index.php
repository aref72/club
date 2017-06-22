<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'password security';
?>
<div class="row text-left">
    <div class="col-lg-4 col-md-4 col-md-offset-4">
        <div class="panel panel-info">
            <div class="panel-heading">system login</div>
            <div class="panel-body">
                <?= Html::beginForm(); ?>  
                    <div class="form-group">
                        <label>password</label>
                        <?= Html::textInput('password', '', [
                            'class' => 'form-control'
                        ]); ?>
                    </div>
                    <?= Html::submitInput('login', [
                        'class' => 'btn btn-sm btn-success'
                    ]); ?>
                <?php Html::endForm(); ?>
            </div>
        </div>
    </div>
</div>
