<?php
$this->title='جزئیات کاربر';
?>
<?php
use yii\widgets\DetailView;
?>
<div style="padding:60px 10px 0px 10px;">
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
</div>
<?php
$css="
    #detailview{
        background:#fff;
    }
    ";
$this->registerCss($css);