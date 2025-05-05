<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
	'Login',
);
?>

<h1>Login</h1>

<p>Si prega di compilare il seguente modulo con le credenziali di accesso:</p>

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'login-form',
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	)); ?>

	<p class="note">I campi con <span class="required">*</span> sono obbligatori.</p>

	<div class="row">
		<?php echo $form->labelEx($model, 'username'); ?>
		<?php echo $form->textField($model, 'username'); ?>
		<?php echo $form->error($model, 'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->passwordField($model, 'password'); ?>
		<?php echo $form->error($model, 'password'); ?>
		<p class="hint">
			In caso di smarrimento password è possibile recuperarla solo tramite il DataBase.
		</p>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model, 'rememberMe'); ?>
		<?php echo $form->label($model, 'rememberMe'); ?>
		<?php echo $form->error($model, 'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

	<?php $this->endWidget(); ?>
</div><!-- form -->