<?php
/* @var $this TaskController */
/* @var $model Task */
/* @var $form CActiveForm */

?>

<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'task-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation' => false,
	)); ?>

	<p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
		<?php echo $form->error($model, 'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'description'); ?>
		<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
		<?php echo $form->error($model, 'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'status'); ?>
		<?php $opzioni = array( // aggiungo opzioni
			'' => 'seleziona lo stato',
			'To_Do' => 'Da fare',
			'In_Progress' => 'In elaborazione',
			'Done' => 'Conclusa'
		); ?>
		<?php echo $form->dropDownList($model, 'status', $opzioni) ?>
		<?php echo $form->error($model, 'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'due_date'); ?>
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
		<?php echo $form->error($model, 'due_date'); ?>
	</div>

	<div class="row">
		<!-- Id utente solo in BACKEND -->
		<!-- per integrare la visualizzazione del utente mettere apertura e chiusura php -->
		<!-- echo $form->labelEx($model,'user_id'); -->
		<!-- echo CHtml::textField('nomeUtente', yii::app()->user->id,array('readOnly' => true)); -->
		<?php echo $form->hiddenField($model, 'user_id', array('value' => $model->user_id)); ?>
		<?php echo $form->error($model, 'user_id'); ?>
	</div>

	<!-- <div class="row"> 
		<?php echo $form->labelEx($model, 'created_at'); ?>
		<?php echo $form->textField($model, 'created_at'); ?>
		<?php echo $form->error($model, 'created_at'); ?>
	</div> -->

	<!-- <div class="row">
		<?php echo $form->labelEx($model, 'updated_at'); ?>
		<?php echo $form->textField($model, 'updated_at');  ?>
		<?php echo $form->error($model, 'updated_at'); ?>
	</div> -->
	
	<?php
	// Imposta il valore attuale solo se il campo è vuoto e nuovo (per la creazione)
	if ($model->isNewRecord && empty($model->created_at)) {
		$model->created_at = date('Y-m-d H:i:s');
	}
	$model->updated_at = date('Y-m-d H:i:s');
	?>
	<?php echo $form->hiddenField($model, 'created_at'); ?>
	<?php echo $form->hiddenField($model, 'updated_at'); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->