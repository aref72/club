<?php
use yii\widgets\DetailView;
?>
<div style="padding:60px 10px 0px 10px;">
<?= DetailView::widget([
    'id' => 'detailview',
    'model' => $cardModel,
]); ?>
</div>
<?php
$css="
    #detailview{
        background:#fff;
    }
    ";
$this->registerCss($css);