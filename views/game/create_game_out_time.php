<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\widgets\Growl;
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
            <div class="panel-heading"><span class="glyphicon glyphicon-inbox"></span> ثبت بازی جدید
            <a href="<?= yii\helpers\Url::to(['create']) ?>" class="btn btn-xs btn-info">بصورت دستی</a>
            </div>
            <div class="panel-body">
            <?php $form = ActiveForm::begin([
                'id'=>'game-form'
            ]); ?>

                <?= $form->field($gameModel, "card_number")->textInput([
                    'placeholder' => 'شماره کارت',
                    'id' => 'card-number'
                ]);?>
                <?= $form->field($gameModel, "type")->dropDownList($gameTypeItems,[
                    'prompt' => '--انتخاب نوع بازی--',
                    'id' => 'input-price'  
                    ])?>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                خروج دستی
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($exitGameModel, "card_number"); ?>
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
";
$this->registerJs($js, \yii\web\View::POS_END);
?>