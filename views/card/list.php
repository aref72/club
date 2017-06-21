<?php
$this->title='CardList';
?>
<?php use yii\helpers\Html; ?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> لیست کارت ها</div>
            <div class="panel-body">
<?= Html::a('ثبت کارت', yii\helpers\Url::to(['create']),['class'=>'btn btn-success']) ?>
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