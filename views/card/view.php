<?php
    use yii\widgets\DetailView;
?>
<div style="padding:60px 10px 0px 10px;">
<?=
    DetailView::widget([
         'id'=>'detailview',
        'model'=>$cardModel,
        'attributes'=>[
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
                'format'=>'raw',
                'value' => ($cardModel->status == 1) ? '<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>'
            ],
            [
                'attribute'=>'card_type',
                 'value'=> function ($model){
                return $model->cardType->name;
            }
                
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