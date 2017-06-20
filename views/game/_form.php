<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\Growl;
use yii\bootstrap\Modal;
$this->title = "playing";
?>
<div class="row" style="margin-top: 20px;">
    <div class="col-lg-6 col-md-6 col-md-offset-3">
        <h2 class="text-center">خوش آمدید</h2>
    </div>
</div>
<div class="row" style="margin-top: 40px;">
    <div class="col-lg-4 col-md-4 col-md-offset-2">
        <div class="panel panel-default animated flipInY">
            <div class="panel-body" id="card-detail" style="height: 365px;">
                <div class="img-rounded"  >
                    
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-default animated flipInY">
            <div class="panel-heading"><span class="glyphicon glyphicon-inbox"></span> ثبت بازی جدید</div>
            <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'id'=>'game-form'
            ]); ?>

                <?= $form->field($gameModel, "card_number")->textInput([
                    'placeholder' => 'شماره کارت',
                    'id' => 'card-number'
                ]);?>
                <?= $form->field($gameModel, "type")->dropDownList($gameTypeItems);?>
                <?= $form->field($gameModel, "process_type")->checkbox([
                    'id' => 'process-type'
                ]) ?>
                <div id="price">
                    <?= $form->field($gameModel, "price")->textInput([
                        'placeholder' => 'مبلغ را وارد کنید'
                    ]);?>
                </div>
                <div id="time">
                    <?= $form->field($gameModel, "out_time")->textInput([
                        'placeholder' => 'مدت زمان بازی'
                    ]);?>
                </div>
                <?= Html::submitInput('ثبت بازی جدید', [
                    'class' => 'btn btn-sm btn-success'
                ]) ?>
            <?php ActiveForm::end(); ?>
            <?php
            foreach (Yii::$app->session->getAllFlashes() as $key => $value) {
                echo Growl::widget([
                    'type' => Growl::TYPE_SUCCESS,
                    'title' => ' '.$value,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                    'delay' => 0,
                    'pluginOptions' => [
                        'placement' => [
                            'from' => 'bottom',
                            'align' => 'right',
                        ]
                    ]
                ]);
            }
            ?>
            </div>
        </div>
    </div>
    
</div>
<audio id="endgame" src="audio/endgame.ogg"></audio>
<audio id="Alert-Atmosphere" src="audio/Alert-Atmosphere.mp3"></audio>
<?php
Modal::begin([
    'id' => 'detail-exit-modal',
    'header' => 'جزییات کارت',
]);
echo '<div id="content-modal"></div>';
Modal::end();
$css = "

    #time{
        display:none;
    }
    #card-detail
    {
        background:url('images/ps4.jpg');
        background-size: cover;
    }
    ";
$this->registerCss($css);
$js = "
    $(document).ready(function(){
        $('#card-number').focus();
        $('#process-type').change(function(){
            var check = $(this).is(':checked');
            if(check)
            {
                $('#time').css('display', 'block');
                $('#price').css('display', 'none');
            }
            else
            {
                 $('#time').css('display', 'none');
                $('#price').css('display', 'block');
            }
        });
    
        $('#card-number').change(function(){
            var cnum = $(this).val();
            $.ajax({
                url:'".Yii::$app->urlManager->createAbsoluteUrl(['card/detail'])."&cnum='+cnum,
            })
            .done(function(data){
                $('#card-detail').html(data);
            })
            .error(function(){
                $('#card-detail').html('<h2 class=\'text-danger text-center\'>کارتی پیدا نشد</h2>');
            });
        });
    });
    
setInterval(function(){
    $.ajax({
        url:'".Yii::$app->urlManager->createAbsoluteUrl(['game/computing'])."'
    }).done(function(data){
        for(var i=0; i< Object.keys(data).length; i++)
        {
            var card_number;
            if(data[i].result == true)
            {
                var card_number = data[i].card_number;
                $.ajax({
                    url:'".Yii::$app->urlManager->createAbsoluteUrl(['card/detail'])."&cnum='+data[i].card_number
                })
                .done(function(data){
                    var html = '<h4>زمان دستگاه با شماره کارت زیر به پایان رسید</h4>';
                    $('#content-modal').append(html+data);
                     $('#detail-exit-modal').modal('show');
                     $('#endgame')[0].play();
                     $('#Alert-Atmosphere')[0].play();
                });
               
            }
        }
    });
}, 5000);
    ";
$this->registerJs($js);
