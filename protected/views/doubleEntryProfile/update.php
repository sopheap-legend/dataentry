<?php
/* @var $this DoubleEntryProfileController */
/* @var $model DoubleEntryProfile */

$this->breadcrumbs=array(
	'Double Entry Profiles'=>array('index'),
	$model->title=>array('view','id'=>$model->file_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DoubleEntryProfile', 'url'=>array('index')),
	array('label'=>'Create DoubleEntryProfile', 'url'=>array('create')),
	array('label'=>'View DoubleEntryProfile', 'url'=>array('view', 'id'=>$model->file_id)),
	array('label'=>'Manage DoubleEntryProfile', 'url'=>array('admin')),
);
?>

<h1>Update DoubleEntryProfile <?php echo $model->file_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>