<?php
/* @var $this DoubleEntryProfileController */
/* @var $data DoubleEntryProfile */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('file_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->file_id), array('view', 'id'=>$data->file_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fullname')); ?>:</b>
	<?php echo CHtml::encode($data->fullname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('national_id')); ?>:</b>
	<?php echo CHtml::encode($data->national_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('province_code')); ?>:</b>
	<?php echo CHtml::encode($data->province_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('district_code')); ?>:</b>
	<?php echo CHtml::encode($data->district_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commune_code')); ?>:</b>
	<?php echo CHtml::encode($data->commune_code); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('village_code')); ?>:</b>
	<?php echo CHtml::encode($data->village_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dob')); ?>:</b>
	<?php echo CHtml::encode($data->dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('msisdn')); ?>:</b>
	<?php echo CHtml::encode($data->msisdn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imsi')); ?>:</b>
	<?php echo CHtml::encode($data->imsi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendorid')); ?>:</b>
	<?php echo CHtml::encode($data->vendorid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_update')); ?>:</b>
	<?php echo CHtml::encode($data->last_update); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('input_status')); ?>:</b>
	<?php echo CHtml::encode($data->input_status); ?>
	<br />

	*/ ?>

</div>