<?php
$this->title='جزئیات مبالغ تعیین شده';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
    use yii\widgets\DetailView;
?>
<div style="padding:60px 10px 0px 10px;">
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

    </div>
<?php
$css="
    #detailview{
        background:#fff;
    }
    ";
$this->registerCss($css);