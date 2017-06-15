<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\Growl;
$this->title = "playing";
?>
<div class="row" style="margin-top: 80px;">
    <div class="col-lg-4 col-md-4 col-md-offset-2">
        <div class="panel panel-default animated flipInY">
            <div class="panel-body" id="card-detail" style="height: 365px;">
                <div class="img-rounded"  >
                    
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-info animated flipInY">
            <div class="panel-heading">ثبت بازی</div>
            <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'id'=>'tarnsaction-form'
            ]); ?>

                <?= $form->field($transactionModel, "card_number")->textInput([
                    'id' => 'card-number'
                ]);?>
                <?= $form->field($transactionModel, "game_type")->dropDownList($gameTypeItems);?>
                <?= $form->field($transactionModel, "process_type")->checkbox([
                    'id' => 'process-type'
                ]) ?>
                <div id="price">
                    <?= $form->field($transactionModel, "price");?>
                </div>
                <div id="time">
                    <?= $form->field($transactionModel, "out_time");?>
                </div>
                <?= Html::submitInput('ثیت', [
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
<?php
$css = "
   #transaction-body
   {
        background:url('images/blue.jpg');
        background-size: cover;
   }
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
    ";
$this->registerJs($js);
