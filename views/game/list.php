<?php
use yii\grid\GridView;
$this->title = "لیست بازی های انجام شده";
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> لیست بازی ها انجام شده</div>
            <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    [
                        'attribute' => 'card_number',
                        'options' => [
                            'width' => '120px'
                        ]
                    ],
                    [
                        'attribute' => 'type',
                        'options' => [
                            'width' => '120px'
                        ],
                        'value' => function($model){
                            return $model->gameType->name;
                        }
                    ],
                    [
                        'attribute' => 'price',
                        'value' => function($model){
                            return number_format($model->price);
                        }
                    ],
                    [
                        'attribute' => 'user_id',
                        'value'=> function($model){
                            return $model->user->username;
                        }
                    ],
                    [
                        'attribute' => 'in_time',
                    ],
                    [
                        'attribute' => 'out_time'
                    ],
                    [
                        'label' => 'نوع کارت',
                        'value' => function($model)
                        {
                            return $model->card->cardType->name;
                        }
                    ]
                ]
            ])
            ?>
            <div>
                مجموع در آمد ها : <?= $gamePriceSum ?> تومن 
            </div>
            </div>
        </div>
    </div>
</div>
