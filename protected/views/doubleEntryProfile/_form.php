<?php
/* @var $this DoubleEntryProfileController */
/* @var $model DoubleEntryProfile */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'double-entry-profile-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'file_id'); ?>
		<?php echo $form->textField($model,'file_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'file_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fullname'); ?>
		<?php echo $form->textField($model,'fullname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'fullname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'national_id'); ?>
		<?php echo $form->textField($model,'national_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'national_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'province_code'); ?>
		<?php echo $form->textField($model,'province_code'); ?>
		<?php echo $form->error($model,'province_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'district_code'); ?>
		<?php echo $form->textField($model,'district_code'); ?>
		<?php echo $form->error($model,'district_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'commune_code'); ?>
		<?php echo $form->textField($model,'commune_code'); ?>
		<?php echo $form->error($model,'commune_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'village_code'); ?>
		<?php echo $form->textField($model,'village_code'); ?>
		<?php echo $form->error($model,'village_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php echo $form->textField($model,'dob',array('size'=>14,'maxlength'=>14)); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'msisdn'); ?>
		<?php echo $form->textField($model,'msisdn',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'msisdn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'imsi'); ?>
		<?php echo $form->textField($model,'imsi',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'imsi'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'vendorid'); ?>
		<?php echo $form->textField($model,'vendorid',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'vendorid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_update'); ?>
		<?php echo $form->textField($model,'last_update',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'last_update'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'input_status'); ?>
		<?php echo $form->textField($model,'input_status'); ?>
		<?php echo $form->error($model,'input_status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->