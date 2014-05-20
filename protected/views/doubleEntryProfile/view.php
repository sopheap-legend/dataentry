<?php
/* @var $this DoubleEntryProfileController */
/* @var $model DoubleEntryProfile */

$this->breadcrumbs=array(
	'Double Entry Profiles'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List DoubleEntryProfile', 'url'=>array('index')),
	array('label'=>'Create DoubleEntryProfile', 'url'=>array('create')),
	array('label'=>'Update DoubleEntryProfile', 'url'=>array('update', 'id'=>$model->file_id)),
	array('label'=>'Delete DoubleEntryProfile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->file_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DoubleEntryProfile', 'url'=>array('admin')),
);
?>

<h1>View DoubleEntryProfile #<?php echo $model->file_id; ?></h1>

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
		'location',
		'dob',
		'msisdn',
		'imsi',
		'vendorid',
		'state',
		'last_update',
		'input_status',
	),
)); ?>
