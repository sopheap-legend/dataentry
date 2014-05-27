<div class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href="<?php echo Yii::app()->urlManager->createUrl('site/index'); ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
              <img src="<?php echo Yii::app()->request->baseUrl ?>/images/logo_bakou.png" width="88" height="68" alt="Bakou">
              <small> Data Entry</small>
          </a>
          
          <div class="nav-collapse">
		   <?php 
                    $this->widget('bootstrap.widgets.TbNavbar', array(
                        'brandLabel' => '',
                        'display' => null,
                        'items' => array(
                            array(
                                    'class' => 'bootstrap.widgets.TbNav',
                                    'items' => array(
                                    array('label'=>'Home', 'url'=>array('/site/index')),   
                                    array('label'=>'Admin', 'url'=>'#','items'=>array(
                                                    array('label'=>'Assignments', 'url'=>array('/auth/view')),
                                                    //array('label'=>'Permissions', 'url'=>'#'),
                                                    array('label'=>'Tasks', 'url'=>'#'),
                                                    array('label'=>'Operations', 'url'=>'#'),
                                            )
                                    ,'visible'=>Yii::app()->user->checkAccess('Admin'),
                                    ),                                               
                                    array('label'=>'Data Entry', 'url'=>'#','items'=>array(
                                            array('label'=>'Single Entry', 'url'=>array('/SingleEntryProfile/SingleEntryForm')),
                                            array('label'=>'Double Entry', 'url'=>array('/DoubleEntryProfile/DoubleEntryForm')),
                                        ), 'visible'=>!Yii::app()->user->isGuest,
                                    ),  
                                    /*array('label'=>'Quality Assure', 'url'=>'#','items'=>array(
                                            array('label'=>'Single Entry', 'url'=>array('/SingleEntryProfile/SingleEntryForm')),
                                            array('label'=>'Double Entry', 'url'=>array('/DoubleEntryProfile/DoubleEntryForm')),
                                        ), 'visible'=>!Yii::app()->user->isGuest,
                                    ),*/     
                                    array('label'=>'Quality Assure', 'url'=>'#','visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Export File', 'url'=>'#','visible'=>!Yii::app()->user->isGuest),
                                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                ),
                            ),
                        ),
                    ));
		?> 
    	</div>
    </div>
</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
        	<div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div>
           <form class="navbar-search pull-right" action="">
           	 
           <input type="text" class="search-query span2" placeholder="Search">
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->
