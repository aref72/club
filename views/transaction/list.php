<?php
use yii\grid\GridView;
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div style="background:#fff">
<?= GridView::widget([
    'dataProvider'=>$dataProvider
]) ?>
            </div>
</div>
</div>
