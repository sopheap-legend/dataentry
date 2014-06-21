<?php
/* @var $this DoubleEntryProfileController */
/* @var $model DoubleEntryProfile */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#double-entry-profile-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php 
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'quality-control-grid',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                    'validateOnSubmit'=>true,
            ),
            //'layout'=>TbHtml::FORM_LAYOUT_VERTICAL,
    ));
?> 
<!--<div class="well" style="max-width: 400px; margin: 0 auto 10px;">-->
<div class="well">
    <div class="span-1">Start Date:
        <div class="input-append">
        <?php 
            $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'name' => 'start_date',
                    'pluginOptions' => array(
                    'format' => 'mm/dd/yyyy'
                )
            ));
        ?>
        <span class="add-on"><icon class="icon-calendar"></icon></span>
        </div>
    </div>    
    <div class="span-1">End Date:
        <div class="input-append">
        <?php 
            $this->widget('yiiwheels.widgets.datepicker.WhDatePicker', array(
                    'name' => 'end_date',
                    'pluginOptions' => array(
                    'format' => 'mm/dd/yyyy'
                )
            ));
        ?>
        <span class="add-on"><icon class="icon-calendar"></icon></span>
        </div>
    </div>  
    <div class="span-1"><?php echo TbHtml::button('View',array('color' => TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_SMALL)); ?></div>
</div>    
    <?php
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
        'title' => 'Quality Control',
         'headerIcon' => 'icon-file',
    ));
    ?> 
    <?php //$filedate=''; ?>
    <div id='grid-control'>
    <?php 
        $this->widget('bootstrap.widgets.TbGridView', array(
        'dataProvider' => $model->qualityControl($filedate),
        'type' => TbHtml::GRID_TYPE_STRIPED,    
        'template' => "{items}",
        'columns'=>array(
                array('name'=>'id',
                       'header'=>'#', 
                ),
                array('name'=>'title',
                       'header'=>'Title', 
                ),
                array('name'=>'fullname',
                       'header'=>'Customer Name', 
                ),
                array('name'=>'national_id',
                       'header'=>'National ID', 
                ),
                array('name'=>'imsi',
                       'header'=>'IMSI', 
                ),
                array('name'=>'msisdn',
                       'header'=>'MSISDN', 
                ),
                array('name'=>'file_name',
                       'header'=>'File Name', 
                ),
                array('name'=>'file_id',
                      'filter'=>false,  
                      'headerHtmlOptions' => array('style' => 'display:none'),
                      'htmlOptions' => array('style' => 'display:none'),  
                ),
                array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{view}{delete}',
                    'buttons'=>array(
                        'view' => array(
                            'url'=>'#',
                        ),
                        'delete' => array(
                            'url'=>'#',
                        ),
                    ),
                ),
            ),
        ));
    ?>
    </div>
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
