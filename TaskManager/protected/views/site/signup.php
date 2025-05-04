<?php
/* @var $this SiteController */
/* @var $model SignupForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Sign Up';
$this->breadcrumbs = array(
    'signup',
);
?>

<h1>Registrazione</h1>

<p>Si prega di compilare il seguente modulo:</p>

<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'signup-form',
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
<!-- Evito email per utilizzo locale -->
	<?php echo $form->hiddenField($model, 'email', array('value' => null)) ?> 

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'password_repeat'); ?>
        <?php echo $form->passwordField($model, 'password_repeat'); ?>
        <?php echo $form->error($model, 'password_repeat'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Invia'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->