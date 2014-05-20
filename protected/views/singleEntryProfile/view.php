<?php
/* @var $this SingleEntryProfileController */
/* @var $model SingleEntryProfile */

$this->breadcrumbs=array(
	'Single Entry Profiles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List SingleEntryProfile', 'url'=>array('index')),
	array('label'=>'Create SingleEntryProfile', 'url'=>array('create')),
	array('label'=>'Update SingleEntryProfile', 'url'=>array('update', 'id'=>$model->file_id)),
	array('label'=>'Delete SingleEntryProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->file_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SingleEntryProfile', 'url'=>array('admin')),
);
?>

<h1>View SingleEntryProfile #<?php echo $model->file_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'file_id',
		'title',
		'fullname',
		'national_id',
		'province_code',
		'district_code',
		'commune_code',
		'village_code',
		'dob',
		'msisdn',
		'imsi',
		'vendorid',
		'state',
		'last_update',
		'folder_path',
	),
)); ?>
