<table>
    <tr>     
        <td>
            <div class="span-1">
                <?php 
                    //for auto complete in Yii bootstrap
                    //http://www.yiiframework.com/extension/bootstrap-twitter-typeahead/
                ?>
                <div>
                    <?php echo $form->labelEx($model,'national_id'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="2" color="red" id="nid-error"></font>
                </div>
                <?php //echo $form->textFieldControlGroup($model,'national_id', array('placeholder' => 'National ID', 'span' => 4))
                    $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
                        'model'=>$model,
                        'attribute'=>'national_id',                        
                        'source'=>Yii::app()->createUrl('SingleEntryProfile/NationalIDList'),
                        'htmlOptions'=>array('placeholder' => 'National ID',),
                        'options'=>array(
                            'select'=>"js:function(nID, ui) {
                                $('#DoubleEntryProfile_national_id').val(ui.item.id);
                            }"
                        ),
                    ));
                ?>
                <?php //echo $form->hiddenField($model,'national_id',array()); ?>
            </div>
            <div class="span-1">                
                <?php echo $form->dropDownListControlGroup($model,'title',array('MR'=>'Mr','MS'=>'Ms',''=>''), array('span' => 2.5)); ?>
            </div>            
        </td>        
    </tr>
    <tr>
        <td>
            <div class="span-1">
                <div>
                    <?php echo $form->labelEx($model,'fullname'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="2" color="red" id="fullname-warning"></font>
                </div>
                <?php echo $form->textField($model,'fullname', array('placeholder' => 'Customer Name', 'span' => 2.5)); ?>
                <?php echo $form->error($model,'fullname'); ?>
            </div>
            <div class="span-1">
                <div><?php echo $form->labelEx($model,'dob'); ?></div>
                <?php //echo $form->textFieldControlGroup($model,'dob', array('placeholder' => 'Date Of Birth', 'span' => 2.5)) 
                    $this->widget(
                            'yiiwheels.widgets.maskinput.WhMaskInput',
                            array(
                                'model'=>$model,
                                'attribute' => 'dob',
                                'mask' => '9999-99-99',
                                'htmlOptions' => array('placeholder' => 'YYYY-MM-DD')
                            )
                        );
                ?>
                <?php echo $form->error($model,'dob'); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div class="span-1">
                <div>
                    <?php 
                        //echo $form->labelEx($model,'province_code'); 
                        //bellow link is for dependent drobdown box in Yii-----
                        //http://www.yiiframework.com/wiki/24/
                    ?>
                </div>
                <?php                   
                    echo $form->dropDownListControlGroup($model,'province_code',
                    @$province, 
                    array(
                        'placeholder' => 'Province',
                        //'prompt'=>'Select Province',
                        'ajax' => array(
                        'type'=>'POST', 
                        'url'=>Yii::app()->createUrl('DoubleEntryProfile/dynamicdistrict'),
                        'update'=>'#DoubleEntryProfile_district_code',
                        //'data'=>array('SingleEntryProfile_district_code'=>'js:this.value'),
                    )));
                ?>
            </div>
            <div class="span-1">                
                <?php 
                    echo $form->dropDownListControlGroup($model,'district_code',
                    //array(''=>'Select District'), 
                    array(''=>'Select District'),         
                    array(      
                        //'prompt'=>'Select District',
                        'placeholder' => 'District',
                        'ajax' => array(
                        'type'=>'POST', 
                        'url'=>Yii::app()->createUrl('DoubleEntryProfile/DynamicCommune'),
                        'update'=>'#DoubleEntryProfile_commune_code',
                        //'data'=>array('province_code'=>'js:this.value'),
                    )));
                    
                ?>
            </div>            
        </td>
    </tr>
    <tr>
        <td>
           <div class="span-1">               
                <?php 
                    echo $form->dropDownListControlGroup($model,'commune_code',
                    array(''=>'Select Commune'), 
                    array(
                        'placeholder' => 'Commune',
                        'ajax' => array(
                        'type'=>'POST', 
                        'url'=>Yii::app()->createUrl('DoubleEntryProfile/DynamicVillage'),
                        'update'=>'#DoubleEntryProfile_village_code',
                        //'data'=>array('province_code'=>'js:this.value'),
                    )));
                ?>
            </div>
            <div class="span-1">
                <div><?php echo $form->labelEx($model,'village_code'); ?></div>
                <?php //echo $form->dropDownListControlGroup($model,'district_code',array('1'=>'Serey Sophorn','2'=>'Au chrov','3'=>''), array('span' => 2.5)) 
                    
                    $this->widget('yiiwheels.widgets.select2.WhSelect2',array(
                        'model'=>$model,
                        'attribute'=>'village_code',
                        'pluginOptions' => array(
                            'placeholder' => 'Village',
                            'allowClear' => true,
                            'width' => '220',
                        ),
                        'data'=>array(''=>'Select Village'),
                    ));
                ?>
            </div>    
        </td>
    </tr>
    <tr>
        <td>
           <div class="span-1">
                <?php echo $form->textFieldControlGroup($model,'village_name',array('placeholder' => 'Village name','span' => 2)); ?>
            </div>
            <div class="span-1">
                <?php echo $form->textFieldControlGroup($model,'street_no',array('placeholder' => 'Street no','span' => 1)) ?>
            </div>  
            <div class="span-1">
                <?php echo $form->textFieldControlGroup($model,'house_no',array('placeholder' => 'House no','span' => 2)); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>           
            <div class="span-1">
                <div>
                    <?php echo $form->labelEx($model,'msisdn'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="2" color="red" id="msisdn-warning"></font>
                </div>
                <?php echo $form->textField($model,'msisdn',array('placeholder' => 'Telephone','span' => 2)) ?>
                <?php echo $form->error($model,'msisdn'); ?>
            </div>  
            <div class="span-1">
                <div>
                    <?php echo $form->labelEx($model,'imsi'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="2" color="red" id="imsi-warning"></font>
                </div>
                <?php echo $form->textField($model,'imsi',array('placeholder' => 'IMSI','span' => 2)); ?>
                <?php echo $form->error($model,'imsi'); ?>
            </div>
            <div class="span-1">
                <div>
                    <?php echo $form->labelEx($model,'vendorid'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <font size="2" color="red" id="vendorid-warning"></font>
                </div>
                <?php echo $form->textField($model,'vendorid',array('placeholder' => 'Vendor ID','span' => 1)); ?>
                <?php echo $form->error($model,'vendorid'); ?>
            </div>
        </td>
    </tr>
</table>