<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = "لیست مبالغ بصورت دستی";
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> لیست مبالغ بصورت دستی</div>
            <div class="panel-body">
                <?= Html::a('ثبت مبلغ جدید', 
                    Url::to(['create']), [
                    'class' => 'btn btn-sm btn-success'
                ]) ?>
                <h4 style="font-family: tahoma;color:#3d80ff">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                    شما دراین بخش می توانید مبلغ و مدت زمان بازی را در سیستم کلوب اضافه کنید.
                </h4>
            <?= GridView::widget([
                 'dataProvider' => $dataProvider,
                    'columns'=>[
                      [  
                          'attribute'=>'id'
                      ],
                      [
                          'attribute'=>'price'
                      ],
                      [
                          'attribute'=>'time'
                      ],  
                      [
                          'attribute' => 'status',
                          'format'=>'raw',
                           'value'=> function ($model){
                           if($model->status==1)
                           {
                              return '<span class="glyphicon glyphicon-ok"></span>';
                            }
                              return '<span class="glyphicon glyphicon-remove"></span>';
                           }
                      ],
                      [  
                          'attribute'=>'card_type',
                            'value'=> function ($model){
                              return $model->cardType->name;
                             }
                      ],
                      [  
                          'attribute'=>'game_type',
                            'value'=> function ($model){
                              return $model->gameType->name;
                             }
                      ],
                      [
                           'class'=> '\yii\grid\ActionColumn'
                      ]
                    ],
             ]); ?>
            </div>
        </div>
    </div>
</div>