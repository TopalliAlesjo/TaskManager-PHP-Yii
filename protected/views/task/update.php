<?php
/* @var $this TaskController */
/* @var $model Task */



$this->menu=array(
	array('label'=>'Crea task', 'url'=>array('create')),
	array('label'=>'Visualizza Task', 'url'=>array('view', 'id'=>$model->id)),
	array('label' => '───────────────'), 
	array('label' => 'Task Da Fare', 'url' => array('manageTask', 'Task[status]' => 'To_Do')),
	array('label' => 'Task In Elaborazione', 'url' => array('manageTask', 'Task[status]' => 'In_Progress')),
	array('label' => 'Task Concluse', 'url' => array('manageTask', 'Task[status]' => 'Done')),
);
?>

<h1>Aggiornamento Task - <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>