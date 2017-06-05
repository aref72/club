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
           'class'=> '\yii\grid\ActionColumn'
       ]
    ]
]) 
?>