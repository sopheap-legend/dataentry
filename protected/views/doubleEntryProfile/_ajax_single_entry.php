<table>
    <tr>     
        <td>
            <div class="span-1">
            <?php //echo $form->textFieldControlGroup($single_model,'national_id', array('placeholder' => 'National ID', 'span' => 2.5)) ?>
                <div><?php echo TbHtml::label('National ID', 'text'); ?></div>
                <?php echo TbHtml::textField('national_id', '', array('id'=>'national_id','placeholder' => 'National ID', 'span' => 2.5,'readonly'=>'readonly')); ?>
            </div>
            <div class="span-1">
                <?php //echo $form->textFieldControlGroup($single_model,'fullname', array('placeholder' => 'Customer Name', 'span' => 2.5)); ?>
                <div><?php echo TbHtml::label('Customer Name', 'text'); ?></div>
                <?php echo TbHtml::textField('fullname', '', array('id'=>'fullname','placeholder' => 'Customer Name', 'span' => 2.5,'readonly'=>'readonly')); ?>
            </div>
        </td>
    </tr>
    <tr>
        <td>           
            <div class="span-1">
                <?php //echo $form->textFieldControlGroup($single_model,'msisdn',array('placeholder' => 'Telephone','span' => 2)) ?>
                <div><?php echo TbHtml::label('Telephone', 'text'); ?></div>
                <?php echo TbHtml::textField('msisdn', '', array('id'=>'msisdn','placeholder' => 'Telephone', 'span' => 2,'readonly'=>'readonly')); ?>
            </div>  
            <div class="span-1">
                <?php //echo $form->textFieldControlGroup($single_model,'imsi',array('placeholder' => 'IMSI','span' => 2)); ?>
                <div><?php echo TbHtml::label('IMSI', 'text'); ?></div>
                <?php echo TbHtml::textField('imsi', '', array('id'=>'imsi','placeholder' => 'IMSI', 'span' => 2,'readonly'=>'readonly')); ?>
            </div>
            <div class="span-1">
                <?php //echo $form->textFieldControlGroup($single_model,'vendorid',array('placeholder' => 'Vendor ID','span' => 1)); ?>
                <div><?php echo TbHtml::label('Vendor ID', 'text'); ?></div>
                <?php echo TbHtml::textField('vendorid', '', array('id'=>'vendorid','placeholder' => 'Vendor ID', 'span' => 1,'readonly'=>'readonly')); ?>
            </div>
        </td>
    </tr>
</table>
