<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	)); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
	</div>
	<!-- METTERE INIZIO E FINE PHP SE SI TOGLIE IL COMMENTO 
	<div class="row">
		echo $form->label($model,'status');
				var_dump($model->status); // <--- QUI
	</div>
	-->
	<?php echo $form->hiddenField($model,'status'); ?> <!-- Prende valore dello status per filtro-->

	<div class="row">
		<?php echo $form->label($model, 'due_date'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'due_date',
			'options' => array(
				'dateFormat' => 'yy-mm-dd',
				'showAnim' => 'explode',
				'showOn' => 'both',
				'changeYear' => true,
			),
			'htmlOptions' => array(
				'readonly' => 'readonly',
				'style' => 'background:#fff;cursor:pointer;',
			),
		));
		?>
	</div>
	<!-- METTERE INIZIO E FINE PHP SE SI TOGLIE IL COMMENTO
	<div class="row">
		echo $form->label($model, 'user_id');
		echo $form->textField($model, 'user_id');
	</div>
	-->
	<div class="row">
		<?php echo $form->label($model, 'created_at'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'created_at',
			'options' => array(
				'dateFormat' => 'yy-mm-dd',
				'showAnim' => 'explode',
				'showOn' => 'both',
				'changeYear' => true,
			),
			'htmlOptions' => array(
				'readonly' => 'readonly',
				'style' => 'background:#fff;cursor:pointer;',
			),
		));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'updated_at'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'updated_at',
			'options' => array(
				'dateFormat' => 'yy-mm-dd',
				'showAnim' => 'explode',
				'showOn' => 'both',
				'changeYear' => true,
			),
			'htmlOptions' => array(
				'readonly' => 'readonly',
				'style' => 'background:#fff;cursor:pointer;',
			),
		));
		?>
	</div>

	<!-- IMPOSTA RESET IN BASE ALLA PAGINA VISITATA -->
	<div class="row buttons">
		<?php
		switch ($model->status) {
			case 'To_Do':
				echo CHtml::link(
					'Reset',
					array('manageTask', 'Task[status]' => 'To_Do'),
					array('class' => 'btn')
				);
				break;
			case 'In_Progress':
				echo CHtml::link(
					'Reset',
					array('manageTask', 'Task[status]' => 'In_Progress'),
					array('class' => 'btn')
				);
				break;
			case 'Done':
				echo CHtml::link(
					'Reset',
					array('manageTask', 'Task[status]' => 'Done'),
					array('class' => 'btn')
				);
				break;
		}
		?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->