<?php
$this->title='CardList';
?>
<?php use yii\helpers\Html; ?>
<?= Html::a('ثبت کارت', yii\helpers\Url::to(['create']),['class'=>'btn btn-success']) ?>
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