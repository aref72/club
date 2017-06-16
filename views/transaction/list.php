<?php
use yii\grid\GridView;
$this->title = "لیست یازی های انجام شده";
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><span class="glyphicon glyphicon-list"></span> لیست بازی ها انجام شده</div>
            <div class="panel-body">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider
            ])
            ?>
            </div>
        </div>
    </div>
</div>
