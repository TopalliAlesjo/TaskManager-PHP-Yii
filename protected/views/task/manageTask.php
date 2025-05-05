<?php
/* @var $this TaskController */
/* @var $model Task */


$this->menu = array(
	// array('label' => 'Lista task', 'url' => array('index')),
	array('label' => 'Crea task', 'url' => array('create')),
	array('label' => '───────────────'), 
	array('label' => 'Task Da Fare', 'url' => array('manageTask', 'Task[status]' => 'To_Do')),
	array('label' => 'Task In Elaborazione', 'url' => array('manageTask', 'Task[status]' => 'In_Progress')),
	array('label' => 'Task Concluse', 'url' => array('manageTask', 'Task[status]' => 'Done')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#task-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<!-- prende lo stato e lo immette nel titolo-->
<h1>Task Manager - <?php echo TaskController::getStatusLabel($model->status,1);?></h1>


<?php echo CHtml::link('Ricerca Avanzata', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search', array(
		'model' => $model,
	)); ?>
</div><!-- search-form -->

<!-- DISABILITO FILTRI STANDARD PER EVENTUALI BYPASS TRAMITE RESET -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'task-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		array(
			'name' => 'id',
			'filter' => false,
		),
		array(
			'name' => 'title',
			'filter' => false,
		),
		array(
			'name' => 'description',
			'filter' => false,
		),
		array(
			'name' => 'status',
			'value' => 'TaskController::getStatusLabel($data->status,0)',
			'filter' => false,
		),
		array(
			'name' => 'due_date',
			'filter' => false,
		),
		/*
		'user_id',
				*/
		array(
			'name' => 'created_at',
			'filter' => false,
		),
		array(
			'name' => 'updated_at',
			'filter' => false,
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update} {delete}', // Template base
			'baseTemplate'=>'{view} {update} {delete}', // Importante: definisci anche baseTemplate
			'stateAttribute'=>'status',
			'stateButtons'=>array(
				'To_Do' => '{inwork} {done}',
				'In_Progress' => '{todo} {done}',
				'Done' => '{todo} {inwork}',
			),
			'buttons'=>array(
				'inwork'=>array(
					'label'=>'<i class="fa fa-play"></i>',
					'url'=>'Yii::app()->controller->createUrl("changeStatus", array("id"=>$data->id, "status"=>"In_Progress"))',
					'options'=>array('title'=>'Metti in lavorazione', 'class'=>'inwork'),
				),
				'done'=>array(
					'label'=>'<i class="fa fa-check"></i>',
					'url'=>'Yii::app()->controller->createUrl("changeStatus", array("id"=>$data->id, "status"=>"Done"))',
					'options'=>array('title'=>'Segna come completata', 'class'=>'done'),
				),
				'todo'=>array(
					'label'=>'<i class="fa fa-undo"></i>',
					'url'=>'Yii::app()->controller->createUrl("changeStatus", array("id"=>$data->id, "status"=>"To_Do"))',
					'options'=>array('title'=>'Riporta in To Do', 'class'=>'todo'),
				),
			),
		),
	),
)); ?>