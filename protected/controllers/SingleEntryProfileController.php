<?php

class SingleEntryProfileController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
                    'postOnly + delete', // we only allow deletion via POST request
            );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
            return array(
                    array('allow',  // allow all users to perform 'index' and 'view' actions
                            'actions'=>array('index','view'),
                            'users'=>array('*'),
                    ),
                    array('allow', // allow authenticated user to perform 'create' and 'update' actions
                            'actions'=>array('create','update','ShowProvince','readpdf','SingleEntryForm','WelcomeImage','RetrieveImage','dynamicdistrict','DynamicCommune','DynamicVillage','NationalIDList','FirstEntrySubmit','RetrieveCustInfo','RejectedReason'),
                            'users'=>array('@'),
                    ),
                    array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions'=>array('admin','delete'),
                            'users'=>array('tsopheap'),
                    ),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
            );
    }
    
    public function exception_error_handler($errno, $errstr, $errfile, $errline ) {
        throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
            $this->render('view',array(
                    'model'=>$this->loadModel($id),
            ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
            $model=new SingleEntryProfile;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['SingleEntryProfile']))
            {
                    $model->attributes=$_POST['SingleEntryProfile'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->file_id));
            }

            $this->render('create',array(
                    'model'=>$model,
            ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
            $model=$this->loadModel($id);

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['SingleEntryProfile']))
            {
                    $model->attributes=$_POST['SingleEntryProfile'];
                    if($model->save())
                            $this->redirect(array('view','id'=>$model->file_id));
            }

            $this->render('update',array(
                    'model'=>$model,
            ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
            $dataProvider=new CActiveDataProvider('SingleEntryProfile');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
            $model=new SingleEntryProfile('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['SingleEntryProfile']))
                    $model->attributes=$_GET['SingleEntryProfile'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return SingleEntryProfile the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
            $model=SingleEntryProfile::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param SingleEntryProfile $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='single-entry-profile-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }

    public function actionSingleEntryForm()
    {            
        $model= new SingleEntryProfile();
        $this->performAjaxValidation($model);  

        $province= CambodiaProvince::model()->get_combo_province();
        //$district= CambodiaDistrict::model()->get_combo_district();
        $this->render('SingleEntry',array('model'=>$model,'province'=>$province,));
    } 

    public function actionRetrieveImage()
    {
        $url=Yii::app()->baseUrl.'/index.php/SingleEntryProfile/ReadPdf/';
        $frame="";
        $frame.="
        <iframe id='fred' style='border:1px solid #666CCC' title='PDF in an i-Frame' 
            src='$url' frameborder='1' scrolling='auto' height='700' width='630' >
        </iframe>";

        $data['status']='success';
        $data['pdfForm']=$frame;  
        echo CJSON::encode($data);
    }

    public function actionReadPdf()
    { 
        $filename=$this->get_randomfile();
        //echo $filename; die();
        try{
            set_error_handler(array(&$this, "exception_error_handler")); 
            if($filename!='NO')
            {
                $cov_filename=substr($filename,strrpos($filename,'/',-1)+1);                
                //$batch_file=substr($cov_filename,0,strpos($cov_filename,'_',5));
                $batch_id=SingleEntryProfile::model()->update_batch_file($cov_filename);                
                Yii::app()->session['filename'] =$cov_filename; //bind filename to session
                Yii::app()->session['batch_file_id']=$batch_id; //bind batch id to ession
                Yii::app()->session['type_input']='SingleEntry';
            }
        }catch(Exception $e) {
            //echo $e->getMessage();
        }
        
        if($filename=='NO')
        {
            $this->renderPartial('_welcome_image');
        }else{
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="$filename"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($filename));
            @readfile($filename);
        }            
    } 

    public function actionWelcomeImage()
    {
        $this->renderPartial('_welcome_image');
    }

    protected function get_randomfile()
    {
        $dir='/vagrant/single_entry';    
        $files = glob($dir . '/*.pdf');
        $avaiale_file=array();
        
        if(!empty($files))
        {            
            foreach($files as $val)
            {
                $filename=substr($val,strrpos($val,'/',-1)+1);
                $chk=SingleEntryProfile::model()->count_unavaiable_file($filename);
                if($chk==0){
                    $avaiale_file[]=$val;
                }
            }
        }        
        
        if(empty($avaiale_file))
        {
            return 'NO';
        }else
        {   
            $file = array_rand($avaiale_file);
            return $avaiale_file[$file];
        }
    } 

    public function actionDynamicDistrict()
    {
        $province = new SingleEntryProfile();
        if(isset($_POST['SingleEntryProfile']))
        {
            $province->attributes=$_POST['SingleEntryProfile'];
            $data= CambodiaDistrict::model()->findAll('province_code=:province_code',array(':province_code'=>(int)$province->province_code));
            $data=CHtml::listData($data,'district_code','district_name');

            echo "<option value=''>Select District</option>";
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option',
                           array('value'=>$value),CHtml::encode($name),true);
            }
        }
    }

    public function actionDynamicCommune()
    {
        $province = new SingleEntryProfile();
        if(isset($_POST['SingleEntryProfile']))
        {
            $province->attributes=$_POST['SingleEntryProfile'];
            $data= CambodiaCommune::model()->findAll('province_code=:province_code and district_code=:district_code',
                    array(
                            ':province_code'=>(int)$province->province_code,
                            ':district_code'=>(int)$province->district_code
                        )
                    );
            $data=CHtml::listData($data,'commune_code','commune_name');
            echo "<option value=''>Select Commune</option>";
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option',
                           array('value'=>$value),CHtml::encode($name),true);
            }
        }
    }

    public function actionDynamicVillage()
    {
        $province = new SingleEntryProfile();
        if(isset($_POST['SingleEntryProfile']))
        {
            $province->attributes=$_POST['SingleEntryProfile'];
            $data= CambodiaVillage::model()
                    ->findAll(
                            'province_code=:province_code 
                                and district_code=:district_code
                                and commune_code=:commune_code',
                    array(
                            ':province_code'=>(int)$province->province_code,
                            ':district_code'=>(int)$province->district_code,
                            ':commune_code'=>(int)$province->commune_code
                        )
                    );
            $data=CHtml::listData($data,'village_code','village_name');
            echo "<option value=''>Select Village</option>";
            foreach($data as $value=>$name)
            {
                echo CHtml::tag('option',
                           array('value'=>$value),CHtml::encode($name),true);
            }
        }
    }

    public function actionShowProvince()
    {
        //$province=CambodiaProvince::model()->test_get_province();
        $province=CambodiaProvince::model()->get_combo_province();
        echo json_encode($province);
    } 

    public function actionFirstEntrySubmit()
    {
        $session = Yii::app()->getSession();       
        $model= new SingleEntryProfile();
        $this->performAjaxValidation($model);        
        
        if(isset($_POST['SingleEntryProfile']))
        {      
            $user_id=Yii::app()->user->getId();
            $transaction=$model->dbConnection->beginTransaction();            
            try 
            {
                set_error_handler(array(&$this, "exception_error_handler")); 
                
                $model->file_id=$model->daily_file_save($session['batch_file_id'], $session['filename']);
                $status=$model->audit_log($model->file_id, $user_id, 'input', '','single');
                if($status)
                {
                    $model->title=$_POST['SingleEntryProfile']['title'];
                    $model->fullname=$_POST['SingleEntryProfile']['fullname'];
                    $model->national_id=$_POST['SingleEntryProfile']['national_id'];
                    $model->province_code=$_POST['SingleEntryProfile']['province_code'];
                    $model->district_code=$_POST['SingleEntryProfile']['district_code'];
                    $model->commune_code=$_POST['SingleEntryProfile']['commune_code'];
                    $model->village_code=$_POST['SingleEntryProfile']['village_code'];
                    $model->location=$_POST['SingleEntryProfile']['village_name'].','.$_POST['SingleEntryProfile']['street_no'].','.$_POST['SingleEntryProfile']['house_no'];
                    $model->dob=$_POST['SingleEntryProfile']['dob'];
                    $model->vendorid=$_POST['SingleEntryProfile']['vendorid'];
                    $model->msisdn=$_POST['SingleEntryProfile']['msisdn'];
                    $model->imsi=$_POST['SingleEntryProfile']['imsi'];
                   
                    if($model->save())
                    {                        
                        $curr_path="/vagrant/single_entry";
                        $next_path="/vagrant/double_entry";
                        $move_file_script='mv '.$curr_path.'/'.$session['filename'].' '.$next_path.'/'.$session['filename'];
                        $output = shell_exec($move_file_script);
                        //echo "<pre>$output</pre>";
                    }
                    
                    Yii::app()->session->remove('filename');
                    Yii::app()->session->remove('batch_file_id'); 
                    $transaction->commit();
                }                
            }catch (Exception $e){
                Yii::app()->session->remove('filename');
                Yii::app()->session->remove('batch_file_id');
                $transaction->rollback();
                //echo $e->getMessage(); die();
            } 
        }        
        $this->redirect(array('SingleEntryForm'));
    }
    
    public function actionRejectedReason()
    {
        //http://www.yiiframework.com/wiki/659/open-bootstrap-modal-and-load-content-via-ajax/
        //$data['reason']= $_POST['reason'];
        //echo json_encode($data);
        if(isset($_POST['reason']))
        {
            $model = new SingleEntryProfile();
            $session = Yii::app()->getSession();  
            $transaction=$model->dbConnection->beginTransaction(); 
            try{
                set_error_handler(array(&$this, "exception_error_handler"));
                if($session['filename']!='')
                {
                    //$status='';
                    $user_id=Yii::app()->user->getId();
                    $model->file_id=$model->daily_file_save($session['batch_file_id'], $session['filename']);                    
                    $status=$model->audit_log($model->file_id, $user_id, 'rejected', $_POST['reason'],'single');
                    if($status)
                    {
                        $curr_path="/vagrant/single_entry";
                        $next_path="/vagrant/rejected";
                        $move_file_script='mv '.$curr_path.'/'.$session['filename'].' '.$next_path.'/'.$session['filename'];
                        $output = shell_exec($move_file_script);
                        //echo "<pre>$output</pre>";
                        
                        Yii::app()->session->remove('filename');
                        Yii::app()->session->remove('batch_file_id'); 
                        
                        $url=Yii::app()->baseUrl.'/index.php/SingleEntryProfile/WelcomeImage/';
                        $frame="";
                        $frame.="
                        <iframe id='fred' style='border:1px solid #666CCC' title='PDF in an i-Frame' 
                            src='$url' frameborder='1' scrolling='auto' height='700' width='630' >
                        </iframe>";

                        $data['status']='success';
                        $data['pdfForm']=$frame;  
                        echo CJSON::encode($data);
                    }
                    $transaction->commit();
                }
            }catch(Exception $e) {
                Yii::app()->session->remove('filename');
                Yii::app()->session->remove('batch_file_id');
                $transaction->rollback();
            }
        }                
    }

    public function actionNationalIDList()
    {
        $return_array=  SingleEntryProfile::model()->NationalIDList();
        echo CJSON::encode($return_array);
    }
    
    protected function GetProvince($province_code)
    {
        //$select_form='';
        $pro_arr=array();
        $data=  CambodiaProvince::model()->find('province_code=:province_code',array(':province_code'=>(int)$province_code));
        $pro_arr=array('province_code'=>$data['province_code'],'province_name'=>$data['province_name']);
        /*$data=CHtml::listData($data,'province_code','province_name');
        $select_form="<option value=''></option>";
        foreach($data as $value=>$name)
        {
            if($value==$province_code)
            {
                $select_form=$select_form. CHtml::tag('option',
                       array('value'=>$value,'selected'=>'selected'),CHtml::encode($name),true);
            }else{
                $select_form=$select_form. CHtml::tag('option',
                       array('value'=>$value),CHtml::encode($name),true);
            }
        }*/
        
        return $pro_arr;
    }

    public function actionRetrieveCustInfo()
    {        
        $model = new SingleEntryProfile();
        if(Yii::app()->request->isAjaxRequest)
        {      
            //$province=array();
            //$cust_info=  CustomerInfo::model()->find('national_id=:national_id',array(':national_id'=>$_POST['national_id']));            
            $cust_info= CustomerInfo::model()->get_customer_info($_POST['national_id']);
            //$province=$this->GetProvince($cust_info['province_code']);
            $data['div_title']=$cust_info['title'];
            $data['div_dob']=$cust_info['dob'];
            $data['div_name']=$cust_info['fullname'];            
            $data['div_vil_name']=$cust_info['village_name'];
            $data['div_str_no']=$cust_info['street_no'];
            $data['div_house_no']=$cust_info['house_no'];
            $data['status']='success';
            
            if($cust_info['province_code']!='')
            {
                $data['div_province_code']= $cust_info['province_code'];
                $data['div_province_name']= $cust_info['province_name'];
            }else{
                $data['div_province_code']='';
                $data['div_province_name']='Select Province';
            }
            
            if($cust_info['district_code']!='')
            {
                //$model->district_code=$cust_info['district_code'];
                $data['div_district_box']= CambodiaDistrict::model()->getDistrict((int)$cust_info['province_code'], (int)$cust_info['district_code']);
                $data['div_district_code']= $cust_info['district_code'];
                $data['div_district_name']= $cust_info['district_name'];
            }else{
                $data['div_district_code']='';
                $data['div_district_name']='Select District';
            }
            
            if($cust_info['commune_code']!='')
            {
                $data['div_commune_box']= CambodiaCommune::model()->getCommune((int)$cust_info['province_code'], 
                                                                                (int)$cust_info['district_code'],
                                                                                (int)$cust_info['commune_code']);
                $data['div_commune_code']= $cust_info['commune_code'];
                $data['div_commune_name']= $cust_info['commune_name'];
            }else{
                $data['div_commune_code']='';
                $data['div_commune_name']='Select Commune';
            }
            
            if($cust_info['village_code']!='')
            {
                $data['div_village_box']= CambodiaVillage::model()->getVillage((int)$cust_info['province_code'],(int)$cust_info['district_code'],(int)$cust_info['commune_code'],(int)$cust_info['village_code']);
                $data['div_village_code']= $cust_info['village_code'];
                $data['div_village_name']= $cust_info['village'];
            }else{
                $data['div_village_code']='';
                $data['div_village_name']='Select Village';
            }            
            //$data['div_single_form']=$this->renderpartial('_ajax_content',array('model'=>$model,));
            echo CJSON::encode($data);
        }            
    }
}
