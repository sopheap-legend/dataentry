<?php
/* @var $this SingleEntryProfileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Single Entry Profiles',
);

$this->menu=array(
	array('label'=>'Create SingleEntryProfile', 'url'=>array('create')),
	array('label'=>'Manage SingleEntryProfile', 'url'=>array('admin')),
);
?>

<h1>Single Entry Profiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
