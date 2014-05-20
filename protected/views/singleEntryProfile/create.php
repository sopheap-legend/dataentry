<?php
/* @var $this SingleEntryProfileController */
/* @var $model SingleEntryProfile */

$this->breadcrumbs=array(
	'Single Entry Profiles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SingleEntryProfile', 'url'=>array('index')),
	array('label'=>'Manage SingleEntryProfile', 'url'=>array('admin')),
);
?>

<h1>Create SingleEntryProfile</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>