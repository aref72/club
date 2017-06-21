<?php
$this->title = "ایجاد مبلغ بصورت دستی";
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="fa fa-dollar fa-fw"></span> ایجاد مبلغ بصورت دستی</div>
            <div class="panel-body">
                <h4 style="font-family: tahoma;color:#3d80ff">
                    <span class="glyphicon glyphicon-arrow-left"></span>
                    شما دراین بخش می توانید مبلغ و مدت زمان بازی را در سیستم کلوب اضافه کنید.
                </h4>
                <?= $this->render('_form', [
                    'priceTimeModel' => $priceTimeModel,
                    'cardTypeItems' => $cardTypeItems,
                    'gameTypeItems'=> $gameTypeItems,
                ]);?>
            </div>
        </div>
    </div>
</div>