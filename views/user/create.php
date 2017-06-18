<?php
$this->title='create';
?>

<div class="row">
    <div class="col-lg-8 col-md-8 col-md-offset-2">
        <div class="panel panel-default animated bounceIn">
            <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> ایجاد کاربر جدید</div>
            <div class="panel-body">
<?php
echo $this->render('_form',[
    'userModel'=>$userModel
])
?>
            </div>
        </div>
    </div>
</div>
