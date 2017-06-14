<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = "playing";
?>
<div class="row">
    <div class="col-lg-4 col-md-4 col-md-offset-2">
        <div class="panel panel-info text-center" style="height: 365px;">
            <div class="panel-heading">جزییات کارت</div>
            <div class="panel-body" id="card-detail">
                
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-info">
            <div class="panel-heading">ثبت بازی</div>
            <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

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
            </div>
        </div>
    </div>
    
</div>
<?php
$css = "
   
    #time{
        display:none;
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
            $('#card-detail').html('<h3 class=\'text-danger\' style=\'margin-top:100px\'>کارتی پیدا نشد</h3>');
        });
    });
    ";
$this->registerJs($js);
