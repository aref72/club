<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
$this->title = "لیست بازی های انجام شده";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-10 col-md-10 col-md-offset-1">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> لیست بازی ها انجام شده</div>
            <div class="panel-body">
                
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $gameSearchModel,
                'columns' => [
                    [
                        'attribute' => 'card_number',
                        'options' => [
                            'width' => '30px'
                        ]
                    ],
                    [
                        'attribute' => 'game_type',
                        'filter' => yii\helpers\ArrayHelper::map(app\models\GameType::find()->asArray()->all(), 'name', 'name'),
                        'options' => [
                            'width' => '120px'
                        ],
                        'value' => function($model){
                            return $model->gameType->name;
                        }
                    ],
                    [
                        'attribute' => 'price',
                        'format' => 'raw',
                        'value' => function($model){
                            return '<div style="text-align:left">'.number_format($model->price).'</div>';
                        }
                    ],
                    [
                        'attribute' => 'username',
                        'filter' => yii\helpers\ArrayHelper::map(\app\modules\account\models\User::find()->asArray()->all(), 'username', 'username'),
                        'value'=> function($model){
                            return $model->user->username;
                        }
                    ],
                    [
                        'attribute' => 'in_time',
                        'options' => [
                            'width' => '150px'
                        ],
                        'filter' => DatePicker::widget([
                            'name' => $gameSearchModel->in_time
                        ]),
                        'value' => function($model){
                            $date = Yii::$app->utility->convertDate([
                                'to' => 'persian',
                                'time' => $model->in_time,
                            ]);
                            return $date['year'].'/'.$date['month_num'].'/'.$date['day'].' - '.$date['hour'].':'.$date['minute'].':'.$date['second'];
                        }
                    ],
                    [
                        'attribute' => 'out_time',
                        'options' => [
                            'width' => '150px'
                        ],
                        'value' => function($model){
                            $date = Yii::$app->utility->convertDate([
                                'to' => 'persian',
                                'time' => $model->out_time,
                            ]);
                            return $date['year'].'/'.$date['month_num'].'/'.$date['day'].' - '.$date['hour'].':'.$date['minute'].':'.$date['second'];
                        }
                    ],
                    [
                        'attribute' => 'card_type',
                        'label' => 'نوع کارت',
                        'filter' => yii\helpers\ArrayHelper::map(\app\models\CardType::find()->asArray()->all(), 'name', 'name'),
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
<script>
    function cardtypeChange(obj){
        var filter = $(obj).val();
        console.log($(obj));
        window.location = "<?= Yii::$app->urlManager->createAbsoluteUrl(['game/list']) ?>&filter_cardtype="+filter;
        return false;
    }
</script>