<?php
$this->title='جزئیات مبالغ تعیین شده';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    use yii\widgets\DetailView;
?>
<div class="row">
    <div class="col-lg-10 col-md-10 col-md-offset-1">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> جزییات</div>
            <div class="panel-body">
<?=
    DetailView::widget([
         'id'=>'detailview',
        'model'=>$priceTimeModel,
        'attributes'=>[
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
                'attribute'=>'id',
            ],
            [
                'attribute'=>'price',
            ],
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value' => ($priceTimeModel->status == 1) ? '<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>'
            ],
            [
                'attribute'=>'time',
            ]
        ]
    ]);?>
     <?= yii\helpers\Html::a('برگشت <i class="glyphicon glyphicon-arrow-left"></i>', yii\helpers\Url::to(['list']), [
        'class' => 'btn btn-sm btn-primary',
        'style' => 'margin-right:10px;'
    ]); ?> 
    </div>
        </div>
    </div>
</div>
<?php
$css="
    #detailview{
        background:#fff;
    }
    ";
$this->registerCss($css);