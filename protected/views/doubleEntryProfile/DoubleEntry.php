<?php //$session = Yii::app()->getSession();
//echo $session['filename'];
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'double-entry-profile-form',
            //'action'=>Yii::app()->createUrl('SingleEntryProfile/FirstEntrySubmit/'),
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
    $url=Yii::app()->createUrl('DoubleEntryProfile/RetrieveImage/');
    Yii::app()->clientScript->registerScript( 'double_retrieve_image',"
            $('#retrieve-image').click(function() {
            $.ajax({
                url:'$url', 
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
    
    $url=Yii::app()->createUrl('DoubleEntryProfile/CheckNationalID/');
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
                url:'$url', 
                dataType : 'json',    
                type : 'post',
                data : {s_national_id:s_national_val,d_national_id:d_national_val},
                success : function(data) {
                        if(data!=null)
                        {   
                            $('#flash-error').html(data.div_nid_error);
                        }else{
                            $('#flash-error').html('');  
                        }                    
                    }
                });
            }
        });
    ");
?>