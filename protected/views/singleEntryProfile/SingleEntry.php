<?php //$session = Yii::app()->getSession();
//echo $session['filename'];
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'single-entry-profile-form',
            'action'=>Yii::app()->createUrl('SingleEntryProfile/FirstEntrySubmit/'),
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                    'validateOnSubmit'=>true,
            ),
            'layout'=>TbHtml::FORM_LAYOUT_INLINE,
    ));
?> 
<div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php 
        echo TbHtml::button('Retrieve Image', 
            array(
                'name'=>'show_image',
                'id'=>'retrieve-image',
                'color' => TbHtml::BUTTON_COLOR_PRIMARY
            )
        );
    ?>
    <?php 
    $this->widget('bootstrap.widgets.TbModal', array(
        'id' => 'show-modal',
        'header' => 'Image Reject Reason',
        'content' => '<div><label for="text">Reason </label></div>
                      <div><input placeholder="Type a Reason" type="text" name="reason" id="reason" /></div>
                      <div id="reason-error"></div>',
        'footer' => implode(' ', array(
            TbHtml::button('Submit', array(
                //'data-dismiss' => 'modal',
                'name'=>'rejected-reason',
                'id'=>'rejected-reason',
                'color' => TbHtml::BUTTON_COLOR_PRIMARY)
            ),
            TbHtml::button('Close', array('data-dismiss' => 'modal')),
         )),
    )); 
    
    echo TbHtml::button('Reject Image', array(
        'id'=>'reject-image',
        'color' => TbHtml::BUTTON_COLOR_DANGER,
        'data-toggle' => 'modal',
        'data-target' => '#show-modal',
    )); 
    ?> 
    <?php 
        /*echo TbHtml::button('Reject Image', 
            array(
                'name'=>'show_image',
                'id'=>'Reject-image',
                'color' => TbHtml::BUTTON_COLOR_DANGER
            )
        ); */
    ?>
</div>
<div class="span16" id="show-pdf">
<?php $url=Yii::app()->baseUrl.'/index.php/SingleEntryProfile/WelcomeImage' ?>
<iframe id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" 
        src="<?php echo @$url; ?>" frameborder="1" scrolling="auto" height="700" width="630" >
</iframe>
</div>
<div class="span6">
    <div class="sidebar-nav">
        <?php
            $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Customer Information/Single Entry',
                'headerIcon' => 'icon-plus',
            ));
        ?>
        <div id="single-entry-form">    
            <?php $this->renderpartial('_ajax_content',array('model'=>$model,'form'=>$form,'province'=>$province)); ?>
        </div>
        <div class="form-actions">
            <?php echo TbHtml::submitButton('Save', array('id'=>'single-entry','color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<?php
//$userid=Yii::app()->getRequest()->getParam('id');
$url=Yii::app()->createUrl('SingleEntryProfile/RetrieveImage/');
Yii::app()->clientScript->registerScript( 'retrieve_image',"
        $('#retrieve-image').click(function() {
        $.ajax({
            url:'$url', 
            dataType : 'json',    
            type : 'post',    
            beforeSend: function() { $('#loading').addClass('waiting'); },
            complete: function() { $('#loading').removeClass('waiting'); },
            success : function(data) {
                if(data.status=='success')
                {
                    $('#show-pdf').html(data.pdfForm);
                }
            }
        });
    });
");

Yii::app()->clientScript->registerScript( 'province_code',"
        $('#SingleEntryProfile_province_code').select2({
            minimumInputLength: 0,
            allowClear : true,
            width:220,
        })
    ");

    Yii::app()->clientScript->registerScript( 'district_code',"
        $('#SingleEntryProfile_district_code').select2({
            minimumInputLength: 0,
            allowClear : true,
            width:220,
        })
    ");

    Yii::app()->clientScript->registerScript( 'commune_code',"
        $('#SingleEntryProfile_commune_code').select2({
            minimumInputLength: 0,
            allowClear : true,
            width:220,
        })
    ");

    Yii::app()->clientScript->registerScript( 'remove_selected_district',"
        $('#SingleEntryProfile_province_code').on('change',function(e) {
            $('#SingleEntryProfile_district_code').select2('data', {id: null, text: 'Select District'});
            $('#SingleEntryProfile_commune_code').select2('data', {id: null, text: 'Select Commune'});
            $('#SingleEntryProfile_village_code').select2('data', {id: null, text: 'Select Village'});
            $('#SingleEntryProfile_commune_code').html('<option value=\'\'>Select Commune<option>');
            $('#SingleEntryProfile_village_code').html('<option value=\'\'>Select Village<option>');
        });
    ");

    Yii::app()->clientScript->registerScript( 'remove_selected_commune',"
        $('#SingleEntryProfile_district_code').on('change',function(e) {
            //$('#SingleEntryProfile_commune_code').select2('data', {id: null, text: 'Select Commune'});
            $('#SingleEntryProfile_village_code').select2('data', {id: null, text: 'Select Village'});
            $('#SingleEntryProfile_commune_code').html('<option value=\'\'>Select Commune<option>');
            $('#SingleEntryProfile_village_code').html('<option value=\'\'>Select Village<option>');
        });
    ");

    Yii::app()->clientScript->registerScript( 'remove_selected_village',"
        $('#SingleEntryProfile_commune_code').on('change',function(e) {
            //$('#SingleEntryProfile_commune_code').select2('data', {id: null, text: 'Select Commune'});
            $('#SingleEntryProfile_village_code').select2('data', {id: null, text: 'Select Village'});
            $('#SingleEntryProfile_village_code').html('<option value=\'\'>Select Village<option>');
        });
    ");
    
    $url=Yii::app()->createUrl('SingleEntryProfile/RetrieveCustInfo/');
    Yii::app()->clientScript->registerScript( 'update_entry_form',"
        $('#SingleEntryProfile_national_id').on('change',function(e) {
            var national_val;
            national_val=$('#SingleEntryProfile_national_id').val();
            $.ajax({
            url:'$url', 
            dataType : 'json',    
            type : 'post',
            data : {national_id:national_val},
            success : function(data) {
                    if(data.status=='success')
                    {
                        //$('#single-entry-form').html(data.div_single_form);
                        //alert(data.divtest);
                        $('#SingleEntryProfile_title').val(data.div_title);
                        $('#SingleEntryProfile_fullname').val(data.div_name);
                        $('#SingleEntryProfile_dob').val(data.div_dob);
                        $('#SingleEntryProfile_village_name').val(data.div_vil_name);
                        $('#SingleEntryProfile_street_no').val(data.div_str_no);
                        $('#SingleEntryProfile_house_no').val(data.div_house_no);
                        $('#SingleEntryProfile_province_code').select2('data', {id: data.div_province_code, text: data.div_province_name});
                        $('#SingleEntryProfile_district_code').html(data.div_district_box);
                        $('#SingleEntryProfile_district_code').select2('data', {id: data.div_district_code, text: data.div_district_name});
                        $('#SingleEntryProfile_commune_code').html(data.div_commune_box);
                        $('#SingleEntryProfile_commune_code').select2('data', {id: data.div_commune_code, text: data.div_commune_name});
                        $('#SingleEntryProfile_village_code').html(data.div_village_box);
                        $('#SingleEntryProfile_village_code').select2('data', {id: data.div_village_code, text: data.div_village_name});
                    }
                }
            });
        });
    ");
    
    $url=Yii::app()->createUrl('SingleEntryProfile/RejectedReason/');
    Yii::app()->clientScript->registerScript( 'rejected_image',"
            $('#rejected-reason').click(function() {
            var myreason=$('#reason').val();
            if (myreason=='')
            {
                $('#reason-error').html('This box cannot be blank');
            }else{
                $.ajax({
                    url:'$url', 
                    dataType : 'json',    
                    type : 'post',
                    data : {reason:myreason},
                    //beforeSend: function() { $('#loading').addClass('waiting'); },
                    //complete: function() { $('#loading').removeClass('waiting'); },
                    success : function(data) {
                        $('#show-modal').modal('hide');  
                        if(data.status=='success')
                        {
                            $('#show-pdf').html(data.pdfForm);
                        }
                    },
                    complete:function(data){
                        $('#single-entry-profile-form').each(function(){
                            this.reset();   //Here form fields will be cleared.
                        });                        
                        $('#reason-error').html('');
                   }
                });
            }            
        });
    ");
?>