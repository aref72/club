<?php
use yii\widgets\DetailView;
?>
<div style="padding:60px 10px 0px 10px;">
<?= DetailView::widget([
    'id' => 'detailview',
    'model' => $cardModel,
    'attributes' => [
        [
            'attribute' => 'card_number',
            'label' => 'دستگاه شماره',
            'value' => '<h3 class="text-center" style="color:#0389ff;font-size: 50px;">'.$cardModel->card_number.'</h3>',
            'format'=>'raw'
        ],
        [
            'attribute' => 'card_type',
               'label' => 'نوع دستگاه',
            'value' => '<h3 class="text-center" style="color:#44f331;">'.$cardModel->cardType->name.'</h3>',
            'format'=>'raw'
        ],
        [
            'attribute' => 'status',
            'format'=>'raw',
            'value' => ($cardModel->status == 1) ? '<p class="text-center"><span class="glyphicon glyphicon-ok" style="color:#5cb85c;"></span></p>':'<p class="text-center"><span class="glyphicon glyphicon-remove" style="color:#f33131;"></span></p>'
        ]
    ]
]); ?>
</div>
<?php
$css="
    #detailview{
        background:#fff;
    }
    ";
$this->registerCss($css);