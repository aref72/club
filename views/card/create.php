<?php
$this->title='ایجاد کارت جدید';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="fa fa-fw fa-id-card-o"></span> ایجاد کارت جدید</div>
            <div class="panel-body">
<?php

echo $this->render('_form',[
    'cardModel'=>$cardModel,
    'CardTypeItem'=>$CardTypeItem
])
?>
          </div>
        </div>
    </div>
</div>
