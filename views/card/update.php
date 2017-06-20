<?php
$this->title='UpdateCard';
?>

<?php
echo $this->render('_form',[
    'cardModel'=>$cardModel,
    'CardTypeItem'=>$CardTypeItem
])
?>