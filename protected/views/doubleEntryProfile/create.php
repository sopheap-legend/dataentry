<?php
/* @var $this DoubleEntryProfileController */
/* @var $model DoubleEntryProfile */

$this->breadcrumbs=array(
	'Double Entry Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DoubleEntryProfile', 'url'=>array('index')),
	array('label'=>'Manage DoubleEntryProfile', 'url'=>array('admin')),
);
?>

<h1>Create DoubleEntryProfile</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>