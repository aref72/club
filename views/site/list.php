<?php
use yii\grid\GridView;
$this->title='list';
?>

<?php
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'id',
        'username',
        [
            'class' => yii\grid\ActionColumn::className(),
        ]
    ]
]);