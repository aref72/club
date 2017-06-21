<?php
$this->title='لیست کارت ها';
?>
<?php use yii\helpers\Html; ?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><i class="fa fa-id-card-o fa-fw" aria-hidden="true"></i> لیست کارت ها</div>
            <div class="panel-body">
<?= Html::a('<i class="fa fa-fw fa-id-card-o" aria-hidden="true"></i> ثبت کارت جدید', yii\helpers\Url::to(['create']),['class'=>'btn btn-success']) ?>
<?=yii\grid\GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        [
            'attribute'=>'id',
        ],
        [
            'attribute'=>'card_number',
        ],
        [
            'attribute'=>'created_at',
        ],
        [
            'attribute'=>'updated_at',
        ],
        [
            'attribute'=>'status',
             'format' => 'raw',
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
           'class'=> '\yii\grid\ActionColumn'
       ]
    ]
]) 
?>
          </div>
        </div>
    </div>
</div>