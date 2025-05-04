<?php
/* @var $this TaskController */
/* @var $model Task */


$this->menu=array(
	array('label' => 'Task Da Fare', 'url' => array('manageTask', 'Task[status]' => 'To_Do')),
	array('label' => 'Task In Elaborazione', 'url' => array('manageTask', 'Task[status]' => 'In_Progress')),
	array('label' => 'Task Concluse', 'url' => array('manageTask', 'Task[status]' => 'Done')),
);
?>
<h1>Creazione task</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>