<?php
/* @var $this TaskController */
/* @var $data Task */
?>
<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php 
	/* FILTRO DA LINGUAGGIO DB A PREDEFINITO */
			$labels = array(
				'To_Do' => 'Da fare',
				'In_Progress' => 'In elaborazione',
				'Done' => 'Conclusa',
				'' => 'nessuno', // si verifica solo in caso di errori
			);
			if (isset($labels[$data->status])) {
				$statuslabel = $labels[$data->status];
			} else {
				$statuslabel = $data->status;
			}
			echo CHtml::encode($statuslabel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('due_date')); ?>:</b>
	<?php echo CHtml::encode($data->due_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	*/ ?>

</div>