<?php
$this->title='لیست کاربران';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
use yii\helpers\Html;

?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> لیست کاربرها</div>
            <div class="panel-body">
<?= Html::a('<span class="fa fa-user fa-fw"></span> ثبت کاربر جدید', yii\helpers\Url::to(['create']),['class'=>'btn btn-success']) ?>
<?=yii\grid\GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'id',
        'username',
        'email',
        [
            'attribute'=>'status',
            'format' => 'raw',
            'value'=> function ($model){
                if($model->status==1)
                {
                    return '<span class="glyphicon glyphicon-ok"></span>';
                }
                return '<span class="glyphicon glyphicon-remove"></span>';
            }
        ],
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
          </div>
        </div>
    </div>
</div>