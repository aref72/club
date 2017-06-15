<?php
$this->title='CreateCard';
?>
<?php
echo $this->render('_form',[
    'cardModel'=>$cardModel,
    'CardTypeItem'=>$CardTypeItem
])
?>