<?php
use app\widgets\BoxHtml;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\Url;
$this->title = Yii::t('app', 'User');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <?php BoxHtml::begin([
            'headerOptions' => [
                'label' => Yii::t('app', 'List users')
            ]
        ]); ?>
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('app', 'Create'), 
                Yii::$app->urlManager->createAbsoluteUrl(['account/user/create']),
                ['class' => 'btn btn-sm btn-success', 'onclick' => 'showModal(this); return false;']); ?>
        <?= GridView::widget([
            'dataProvider' => $userDataProvider,
            'filterModel'=> $userSearchModel,
            'resizableColumns'=>true,
            'columns' => [
                'id',
                'username',
                [
                    'attribute' => 'status'
                ],
                [
                    'attribute' => 'created_at'
                ],
                [
                    'attribute' => 'updated_at'
                ],
                [
                    'attribute' => 'roleName',
                    'value' => function($model){
                        return $model->roleName;
                    }
                ],
                [
                    'class' => kartik\grid\ActionColumn::className(),
                    'template' => '{view}{update}{delete}',
                    'buttons' => [
                        'view' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
                                    Url::to(['view', 'id' => $model->id]), 
                                    [
                                        'onclick' => 'showModal(this); return false;',
                                        'data-pjax' => 0
                                    ]);
                        },
                        'update' => function($url, $model, $key){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                            Url::to(['update', 'id' => $model->id]),
                                    [
                                        'onclick' => 'showModal(this); return false;',
                                        'data-pjax' => 0
                                    ]);
                        },
                    ]
                ]
            ]
        ]); 
        echo Html::a('<span class="glyphicon glyphicon-trash"></span> '.Yii::t('app', 'delete select item'), 
            yii::$app->urlManager->createAbsoluteUrl(['parking/card/delete-items']), 
        ['class' => 'btn btn-sm btn-primary', 'onclick' => 'deleteItems(this); return false;']);
        ?>
        
        <?php BoxHtml::end(); ?>
    </div>
</div>

<?php
Modal::begin([
    'id' => 'user-modal',
    'header' => 'user',
]); 
Pjax::begin(['id' => 'user-pjax']);
$js = "
    function showModal(obj){
        $('#user-modal').modal('show');
        $('#user-pjax').html('');
        $.ajax({
            url:$(obj).attr('href'),
        })
        .done(function(data){
            $('#user-pjax').html(data);
        })
        .error(function(data){
            var html = '<h4 style=\'color:red;\'>'+data.statusText+' ('+data.status+')</h4>'
                +'<p>'+data.responseText+'</p>';
            $('#user-pjax').html(html);
        });
    }
    
    $('#user-pjax').on('pjax:success', function(e, r){
        if(r == 1){
            $('#user-modal').modal('hide');
        }
    });
";
$this->registerJs($js, yii\web\View::POS_END);
Pjax::end();
Modal::end();
?>



