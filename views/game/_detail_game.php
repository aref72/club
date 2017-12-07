<?php
use yii\widgets\DetailView;
$in_time = Yii::$app->utility->convertDate(['to' => 'persian', 'time' => $gameModel->in_time]);
$out_time = Yii::$app->utility->convertDate(['to' => 'persian', 'time' => $gameModel->out_time]);
$time = ($gameModel->out_time - $gameModel->in_time)/ 60;
?>
<?= DetailView::widget([
    'model' => $gameModel,
    'attributes' => [
        [
            'attribute' => 'card_number'
        ],
        [
            'attribute' => 'in_time',
            'value' => $in_time['year'].'/'.$in_time['month_num'].'/'.$in_time['day'].
                ' - '.$in_time['hour'].':'.$in_time['minute'].':'.$in_time['second']
        ],
        [
            'attribute' => 'out_time',
            'value' => $out_time['year'].'/'.$out_time['month_num'].'/'.$out_time['day'].
                ' - '.$out_time['hour'].':'.$out_time['minute'].':'.$out_time['second']
        ],
        [
            'attribute' => 'type',
            'value' => $gameModel->gameType->name
        ],
        [
            'attribute' => 'user_id',
            'value' => $gameModel->user->username
        ],
        [
            'label' =>'مدت زمان', 
            'value' => ceil($time).' دقیقه'
        ],
        [
            'attribute' => 'price',
            'value' => number_format($gameModel->price).' تومان',
        ],
    ]
]); ?>

