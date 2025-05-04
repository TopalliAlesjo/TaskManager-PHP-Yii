<?php
/* @var $this TaskController */
/* @var $model Task */



$this->menu=array(
	array('label'=>'Crea task', 'url'=>array('create')),
	array('label'=>'Aggiorna Task', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Elimina Task', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Sei sicuro di voler eliminare questa task?')),
	array('label' => '───────────────'), 
	array('label' => 'Task Da Fare', 'url' => array('manageTask', 'Task[status]' => 'To_Do')),
	array('label' => 'Task In Elaborazione', 'url' => array('manageTask', 'Task[status]' => 'In_Progress')),
	array('label' => 'Task Concluse', 'url' => array('manageTask', 'Task[status]' => 'Done')),
)
?>
<h1>Visualizzazione Task #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		array(
			'name' => 'status',
			'value' => $statuslabel,
		),
		'due_date',
		//'user_id', tolgo la visibilità al user id
		'created_at',
		'updated_at',
	),
)); ?>
