<?php
$this->title='جزئیات کاربر';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
use yii\widgets\DetailView;
?>
<div class="row">
    <div class="col-lg-10 col-md-10 col-md-offset-1">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> جزییات</div>
            <div class="panel-body">
<?= DetailView::widget([
    'id' => 'detailview',
    'model' => $userModel,
    'attributes' => [
        [
            'attribute' => 'id'
        ],
        [
            'attribute'=>'username'
        ],
        [
            'attribute'=>'email'
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
            'attribute' => 'created_at',
        ],
        [
            'attribute' => 'updated_at'
        ],
        [
            'attribute' => 'status',
            'format'=>'raw',
            'value' => ($userModel->status == 1) ? '<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>'
        ]
    ]
]); ?>
    <?= yii\helpers\Html::a('برگشت <i class="glyphicon glyphicon-arrow-left"></i>', yii\helpers\Url::to(['list']), [
        'class' => 'btn btn-sm btn-primary'
    ]); ?> 
</div>
        </div>
    </div>
</div>
<?php
$css="
    #detailview{
        background:#fff;
    }
    ";
$this->registerCss($css);