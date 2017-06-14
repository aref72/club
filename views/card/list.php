<?php
$this->title='CardList';
?>
<?=yii\grid\GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'id',
        'card_number',
        'created_at',
        'updated_at',
        'status',
        'card_type',
       [
           'class'=> '\yii\grid\ActionColumn'
       ]
    ]
]) 
?>