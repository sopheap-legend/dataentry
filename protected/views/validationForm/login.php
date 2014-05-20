<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
?>

<div class="page-header">
	<h1>Login <small>to your account</small></h1>
</div>
<div class="row-fluid">
<div class="span6 offset3">
<?php 
    $box = $this->beginWidget('yiiwheels.widgets.box.WhBox', array(
            'title' => 'Private access',
             'headerIcon' => 'icon-lock',
        )); 
?> 
    <p>Please fill out the following form with your login credentials:</p> 
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'login-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                    'validateOnSubmit'=>true,
            ),
            //'type'=>'horizontal',
    )); ?>

            <p class="help-block">Fields with <span class="required">*</span> are required.</p>

            <?php echo $form->textFieldControlGroup($model,'username',array('class'=>'span4','maxlength'=>40)); ?>

            <?php echo $form->passwordFieldControlGroup($model,'password',array('class'=>'span4','maxlength'=>30,'hint'=>'Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>')); ?>
            <div class="form-actions">
                <?php
                echo TbHtml::submitButton('Login',array(
                    'color'=>TbHtml::BUTTON_COLOR_PRIMARY,
                    'size'=>TbHtml::BUTTON_SIZE_SMALL,
                ));
                ?>
            </div>    
    <?php $this->endWidget(); ?>
<?php $this->endWidget(); ?>
</div>
</div>
