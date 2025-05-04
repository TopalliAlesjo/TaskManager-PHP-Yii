<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Benvenuto nel <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<!-- nomi collegati tramite framework per evitare cambi manuali in futuro-->
<p>Effettua subito la registrazione utente per poter usufruire del <?php echo CHtml::encode(Yii::app()->name)?></p>
<p style="color:blue">Precisazione, ogni utente ha le proprie task. </p>
<p style="color:red">Attenzione, le password in caso di smarrimento sono recuperabili solo tramite DataBase! </p>
<?php echo CHtml::link('Registrati Ora', array('site/signup'), array('class' => 'btn')); ?>
