<?php //$session = Yii::app()->getSession();
//echo $session['filename'];
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'double-entry-profile-form',
            'action'=>Yii::app()->createUrl('DoubleEntryProfile/SecondEntrySubmit/'),
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
    /*$this->widget('bootstrap.widgets.TbModal', array(
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
    )); */
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
<?php $url=Yii::app()->baseUrl.'/index.php/DoubleEntryProfile/WelcomeImage' ?>
<iframe id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" 
        src="<?php echo @$url; ?>" frameborder="1" scrolling="auto" height="820" width="630">
</iframe>
</div>
<div class="message span16" style="display:none;width:570px">
   <div class="alert in alert-block fade alert-success"></div>
</div>
<div class="span6">
    <div class="sidebar-nav">
        <?php
            $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Verification Information/Double Entry',
                'headerIcon' => 'icon-plus',
            ));
        ?>
        <div id="double-entry-form">    
            <?php $this->renderpartial('_ajax_content',array('model'=>$model,'form'=>$form,'province'=>$province)); ?>
        </div>
        <div class="form-actions">
            <?php echo TbHtml::submitButton('Save', array('id'=>'single-entry','color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="span6">
    <div class="sidebar-nav">
        <?php
            $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
                'title' => 'Customer Information/Single Entry',
                'headerIcon' => 'icon-plus',
            ));
        ?>
        <div id="double-entry-form">    
            <?php $this->renderpartial('_ajax_single_entry',array('form'=>$form)); ?>
        </div>        
        <?php $this->endWidget(); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<?php
    //$url=Yii::app()->createUrl('DoubleEntryProfile/RetrieveImage/');
    Yii::app()->clientScript->registerScript( 'double_retrieve_image',"
            $('#retrieve-image').click(function() {
            $.ajax({
                url:'RetrieveImage', 
                dataType : 'json',    
                type : 'post',    
                //beforeSend: function() { $('#loading').addClass('waiting'); },
                //complete: function() { $('#loading').removeClass('waiting'); },
                success : function(data) {
                    if(data.status=='success')
                    {
                        $('#show-pdf').html(data.pdfForm);
                        $('#national_id').val(data.div_national_id);
                        $('#fullname').val(data.div_fullname);
                        $('#msisdn').val(data.div_msisdn);
                        $('#imsi').val(data.div_imsi);
                        $('#vendorid').val(data.div_vendorid);
                    }
                }
            });
        });
    ");
    
    Yii::app()->clientScript->registerScript( 'double_province_code',"
        $('#DoubleEntryProfile_province_code').select2({
            minimumInputLength: 0,
            allowClear : true,
            width:220,
        })
    ");

    Yii::app()->clientScript->registerScript( 'double_district_code',"
        $('#DoubleEntryProfile_district_code').select2({
            minimumInputLength: 0,
            allowClear : true,
            width:220,
        })
    ");

    Yii::app()->clientScript->registerScript( 'double_commune_code',"
        $('#DoubleEntryProfile_commune_code').select2({
            minimumInputLength: 0,
            allowClear : true,
            width:220,
        })
    ");
    
    //to check whether it matched with single entry?
    Yii::app()->clientScript->registerScript( 'check_national_id',"
        $('#DoubleEntryProfile_national_id').on('change',function(e) {
            var s_national_val;
            var d_national_val;
            s_national_val=$('#national_id').val();
            d_national_val=$('#DoubleEntryProfile_national_id').val();
            if(s_national_val=='')
            {
               $('.message').hide();
               $('.load-indicator').slideUp('slow');
               $('.message').slideToggle();
               $('div.alert').html('Please Retrieve Your Image first');
               $('.message').animate({opacity: 1.0}, 3000).fadeOut('slow');
            }else
            {
                $.ajax({
                url:'CheckNationalID', 
                dataType : 'json',    
                type : 'post',
                data : {s_national_id:s_national_val,d_national_id:d_national_val},
                success : function(data) {
                        if(data!=null)
                        {   
                            $('#nid-error').html(data.div_nid_error);
                        }else{
                            $('#nid-error').html('');  
                        }                    
                    }
                });
            }
        });
    ");    
    
    //to check whether it matched with single entry?
    Yii::app()->clientScript->registerScript( 'check_fullname',"
        $('#DoubleEntryProfile_fullname').on('change',function(e) {
            var s_fullname_val;
            var d_fullname_val;
            s_fullname_val=$('#fullname').val();
            d_fullname_val=$('#DoubleEntryProfile_fullname').val();
            if(s_fullname_val=='')
            {
               $('.message').hide();
               $('.load-indicator').slideUp('slow');
               $('.message').slideToggle();
               $('div.alert').html('Please Retrieve Your Image first');
               $('.message').animate({opacity: 1.0}, 3000).fadeOut('slow');
            }else
            {
                $.ajax({
                url:'CheckFullname', 
                dataType : 'json',    
                type : 'post',
                data : {s_fullname:s_fullname_val,d_fullname:d_fullname_val},
                success : function(data) {
                        if(data!=null)
                        {   
                            $('#fullname-warning').html(data.div_fullname_warn);
                        }else{
                            $('#fullname-warning').html('');  
                        }                    
                    }
                });
            }
        });
    ");
    
    //to check whether it matched with single entry?
    Yii::app()->clientScript->registerScript( 'check_msisdn',"
        $('#DoubleEntryProfile_msisdn').on('change',function(e) {
            var s_msisdn_val;
            var d_msisdn_val;
            s_msisdn_val=$('#msisdn').val();
            d_msisdn_val=$('#DoubleEntryProfile_msisdn').val();
            if(s_msisdn_val=='')
            {
               $('.message').hide();
               $('.load-indicator').slideUp('slow');
               $('.message').slideToggle();
               $('div.alert').html('Please Retrieve Your Image first');
               $('.message').animate({opacity: 1.0}, 3000).fadeOut('slow');
            }else
            {
                $.ajax({
                url:'CheckMsisdn', 
                dataType : 'json',    
                type : 'post',
                data : {s_msisdn:s_msisdn_val,d_msisdn:d_msisdn_val},
                success : function(data) {
                        if(data!=null)
                        {   
                            $('#msisdn-warning').html(data.div_msisdn_warn);
                        }else{
                            $('#msisdn-warning').html('');  
                        }                    
                    }
                });
            }
        });
    ");
    
    //to check whether it matched with single entry?
    Yii::app()->clientScript->registerScript( 'check_imsi',"
        $('#DoubleEntryProfile_imsi').on('change',function(e) {
            var s_imsi_val;
            var d_imsi_val;
            s_imsi_val=$('#imsi').val();
            d_imsi_val=$('#DoubleEntryProfile_imsi').val();
            if(s_imsi_val=='')
            {
               $('.message').hide();
               $('.load-indicator').slideUp('slow');
               $('.message').slideToggle();
               $('div.alert').html('Please Retrieve Your Image first');
               $('.message').animate({opacity: 1.0}, 3000).fadeOut('slow');
            }else
            {
                $.ajax({
                url:'CheckImsi', 
                dataType : 'json',    
                type : 'post',
                data : {s_imsi:s_imsi_val,d_imsi:d_imsi_val},
                success : function(data) {
                        if(data!=null)
                        {   
                            $('#imsi-warning').html(data.div_imsi_warn);
                        }else{
                            $('#imsi-warning').html('');  
                        }                    
                    }
                });
            }
        });
    ");
    
    //to check whether it matched with single entry?
    Yii::app()->clientScript->registerScript( 'check_vendorid',"
        $('#DoubleEntryProfile_vendorid').on('change',function(e) {
            var s_vendorid_val;
            var d_vendorid_val;
            s_vendorid_val=$('#vendorid').val();
            d_vendorid_val=$('#DoubleEntryProfile_vendorid').val();
            if(s_vendorid_val=='')
            {
               $('.message').hide();
               $('.load-indicator').slideUp('slow');
               $('.message').slideToggle();
               $('div.alert').html('Please Retrieve Your Image first');
               $('.message').animate({opacity: 1.0}, 3000).fadeOut('slow');
            }else
            {
                $.ajax({
                url:'CheckVendorID', 
                dataType : 'json',    
                type : 'post',
                data : {s_vendorid:s_vendorid_val,d_vendorid:d_vendorid_val},
                success : function(data) {
                        if(data!=null)
                        {   
                            $('#vendorid-warning').html(data.div_vendorid_warn);
                        }else{
                            $('#vendorid-warning').html('');  
                        }                    
                    }
                });
            }
        });
    ");
    
    //update province, district, commune, village in select2 box
    Yii::app()->clientScript->registerScript( 'double_remove_selected_district',"
        $('#DoubleEntryProfile_province_code').on('change',function(e) {
            $('#DoubleEntryProfile_district_code').select2('data', {id: null, text: 'Select District'});
            $('#DoubleEntryProfile_commune_code').select2('data', {id: null, text: 'Select Commune'});
            $('#DoubleEntryProfile_village_code').select2('data', {id: null, text: 'Select Village'});
            $('#DoubleEntryProfile_commune_code').html('<option value=\'\'>Select Commune<option>');
            $('#DoubleEntryProfile_village_code').html('<option value=\'\'>Select Village<option>');
        });
    ");

    Yii::app()->clientScript->registerScript( 'double_remove_selected_commune',"
        $('#DoubleEntryProfile_district_code').on('change',function(e) {
            //$('#DoubleEntryProfile_commune_code').select2('data', {id: null, text: 'Select Commune'});
            $('#DoubleEntryProfile_village_code').select2('data', {id: null, text: 'Select Village'});
            $('#DoubleEntryProfile_commune_code').html('<option value=\'\'>Select Commune<option>');
            $('#DoubleEntryProfile_village_code').html('<option value=\'\'>Select Village<option>');
        });
    ");

    Yii::app()->clientScript->registerScript( 'double_remove_selected_village',"
        $('#DoubleEntryProfile_commune_code').on('change',function(e) {
            //$('#DoubleEntryProfile_commune_code').select2('data', {id: null, text: 'Select Commune'});
            $('#DoubleEntryProfile_village_code').select2('data', {id: null, text: 'Select Village'});
            $('#DoubleEntryProfile_village_code').html('<option value=\'\'>Select Village<option>');
        });
    ");
    
    //to auto update the customer info in double entry form
    Yii::app()->clientScript->registerScript( 'update_double_entry_form',"
        $('#DoubleEntryProfile_national_id').on('change',function(e) {
            var national_val;
            national_val=$('#DoubleEntryProfile_national_id').val();
            $.ajax({
            url:'RetrieveCustInfo', 
            dataType : 'json',    
            type : 'post',
            data : {national_id:national_val},
            success : function(data) {
                    if(data.status=='success')
                    {
                        $('#DoubleEntryProfile_title').val(data.div_title);
                        $('#DoubleEntryProfile_fullname').val(data.div_name);
                        $('#DoubleEntryProfile_dob').val(data.div_dob);
                        $('#DoubleEntryProfile_village_name').val(data.div_vil_name);
                        $('#DoubleEntryProfile_street_no').val(data.div_str_no);
                        $('#DoubleEntryProfile_house_no').val(data.div_house_no);
                        $('#DoubleEntryProfile_province_code').select2('data', {id: data.div_province_code, text: data.div_province_name});
                        $('#DoubleEntryProfile_district_code').html(data.div_district_box);
                        $('#DoubleEntryProfile_district_code').select2('data', {id: data.div_district_code, text: data.div_district_name});
                        $('#DoubleEntryProfile_commune_code').html(data.div_commune_box);
                        $('#DoubleEntryProfile_commune_code').select2('data', {id: data.div_commune_code, text: data.div_commune_name});
                        $('#DoubleEntryProfile_village_code').html(data.div_village_box);
                        $('#DoubleEntryProfile_village_code').select2('data', {id: data.div_village_code, text: data.div_village_name});
                    }
                }
            });
        });
    ");
    
    Yii::app()->clientScript->registerScript( 'double_prevent_no_retrieve_image',"
        $('#single-entry').click(function(e) {
            var s_national_val;
            s_national_val=$('#national_id').val();
            if(s_national_val=='')
            {
               e.preventDefault();
               $('.message').hide();
               $('.load-indicator').slideUp('slow');
               $('.message').slideToggle();
               $('div.alert').html('Please Retrieve Your Image first');
               $('.message').animate({opacity: 1.0}, 3000).fadeOut('slow');
            }
        });
    ");
?>