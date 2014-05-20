<?php
/* @var $this DoubleEntryProfileController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Double Entry Profiles',
);

$this->menu=array(
	array('label'=>'Create DoubleEntryProfile', 'url'=>array('create')),
	array('label'=>'Manage DoubleEntryProfile', 'url'=>array('admin')),
);
?>

<h1>Double Entry Profiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
