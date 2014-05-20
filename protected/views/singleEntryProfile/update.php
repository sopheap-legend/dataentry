<?php
/* @var $this SingleEntryProfileController */
/* @var $model SingleEntryProfile */

$this->breadcrumbs=array(
	'Single Entry Profiles'=>array('index'),
	$model->title=>array('view','id'=>$model->file_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SingleEntryProfile', 'url'=>array('index')),
	array('label'=>'Create SingleEntryProfile', 'url'=>array('create')),
	array('label'=>'View SingleEntryProfile', 'url'=>array('view', 'id'=>$model->file_id)),
	array('label'=>'Manage SingleEntryProfile', 'url'=>array('admin')),
);
?>

<h1>Update SingleEntryProfile <?php echo $model->file_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>