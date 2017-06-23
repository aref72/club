<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = "لیست یازی های انجام شده";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> لیست بازی ها انجام شده</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                    <div class="col-lg-8 col-md-8 col-md-offset-2">
                    <?= Html::dropDownList('', NULL, [1=> 'xbox', 2=> 'ps4', 3=> 'biliard'], [
                        'prompt' => '--انتخاب نوع دستگاه--',
                        'class' => 'form-control',
                        'onchange' => 'cardtypeChange(this); return false;'
                    ]); ?>  
                    </div>
                        <div class="col-lg-2 col-md-2" style="padding-top: 7px;">
                    <label>فیلتر براساس : </label>
                    </div>
                    </div>
                </div>
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
<script>
    function cardtypeChange(obj){
        var filter = $(obj).val();
        console.log($(obj));
        window.location = "<?= Yii::$app->urlManager->createAbsoluteUrl(['game/list']) ?>&filter_cardtype="+filter;
        return false;
    }
</script>