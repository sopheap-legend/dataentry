<div id="single-entry-form">    
    <?php $this->renderpartial('_ajax_content',array('model'=>$model,'form'=>$form,'province'=>$province)); ?>
</div>
<div class="form-actions">
    <?php echo TbHtml::submitButton('Primary', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
</div>

<?php
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
                    }
                }
            });
        });
    ");
?>