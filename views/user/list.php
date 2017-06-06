<?php
$this->title='list';
?>
<?=yii\grid\GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'id',
        'username',
        'email',
        'status',
        [
            'attribute' => 'level',
            'value' => function($model){
                if($model->level == 1)
                {
                    return "مدیر";
                }
                else if($model->level == 2)
                {
                    return "کاربر";
                }
            }
        ],
       [
           'class'=> '\yii\grid\ActionColumn'
       ]
    ]
]) 
?>