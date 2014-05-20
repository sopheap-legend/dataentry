<?php

class DoubleEntryProfileController extends Controller
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
                            'actions'=>array('create','update','DoubleEntryForm','ReadPdf','RetrieveImage','WelcomeImage','DynamicDistrict','DynamicCommune','DynamicVillage','CheckNationalID'),
                            'users'=>array('@'),
                    ),
                    array('allow', // allow admin user to perform 'admin' and 'delete' actions
                            'actions'=>array('admin','delete'),
                            'users'=>array('admin'),
                    ),
                    array('deny',  // deny all users
                            'users'=>array('*'),
                    ),
            );
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
            $model=new DoubleEntryProfile;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['DoubleEntryProfile']))
            {
                    $model->attributes=$_POST['DoubleEntryProfile'];
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

            if(isset($_POST['DoubleEntryProfile']))
            {
                    $model->attributes=$_POST['DoubleEntryProfile'];
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
            $dataProvider=new CActiveDataProvider('DoubleEntryProfile');
            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
            $model=new DoubleEntryProfile('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['DoubleEntryProfile']))
                    $model->attributes=$_GET['DoubleEntryProfile'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return DoubleEntryProfile the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
            $model=DoubleEntryProfile::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param DoubleEntryProfile $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
            if(isset($_POST['ajax']) && $_POST['ajax']==='double-entry-profile-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }
    }
        
    public function actionDoubleEntryForm()
    {            
        $model= new DoubleEntryProfile();
        $this->performAjaxValidation($model);  

        $province= CambodiaProvince::model()->get_combo_province();
        //$district= CambodiaDistrict::model()->get_combo_district();
        $this->render('DoubleEntry',array('model'=>$model,'province'=>$province,));
    } 

    public function actionRetrieveImage()
    {
        //$filepath=$this->get_randomfile();
        //$filename=substr($filepath,strrpos($filepath,'\\',-1)+1);
        
        //$file_input = DailyFileInput::model()->find('file_name=:file_name',array('file_name'=>$session['double_filename']));
        //$cust_profile = SingleEntryProfile::model()->findBypk($file_input->file_id);
        
        $url=Yii::app()->baseUrl.'/index.php/DoubleEntryProfile/ReadPdf/';
        $frame="";
        $frame.="
        <iframe id='fred' style='border:1px solid #666CCC' title='PDF in an i-Frame' 
            src='$url' frameborder='1' scrolling='auto' height='820' width='630' >
        </iframe>";
        $session = Yii::app()->getSession();
        $cust_profile = SingleEntryProfile::model()->with('daily_input')->find('file_name=:file_name',array('file_name'=>$session['double_filename']));
        $data['status']='success';
        $data['div_national_id']=$cust_profile['national_id'];
        $data['div_fullname']=$cust_profile['fullname'];
        $data['div_msisdn']=$cust_profile['msisdn'];
        $data['div_imsi']=$cust_profile['imsi'];
        $data['div_vendorid']=$cust_profile['vendorid'];
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
                Yii::app()->session['double_filename'] =$cov_filename; //bind filename to session
                Yii::app()->session['double_batch_id']=$batch_id; //bind batch id to ession
                Yii::app()->session['type_input']='DoubleEntry';
            }
        }catch(Exception $e) {
            echo $e->getMessage();
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
        $dir='/vagrant/double_entry';
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
        $province = new DoubleEntryProfile();
        if(isset($_POST['DoubleEntryProfile']))
        {
            $province->attributes=$_POST['DoubleEntryProfile'];
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
        $province = new DoubleEntryProfile();
        if(isset($_POST['DoubleEntryProfile']))
        {
            $province->attributes=$_POST['DoubleEntryProfile'];
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
        $province = new DoubleEntryProfile();
        if(isset($_POST['DoubleEntryProfile']))
        {
            $province->attributes=$_POST['DoubleEntryProfile'];
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
    
    public function actionCheckNationalID()
    {
        if(isset($_POST['s_national_id']) && $_POST['d_national_id'])
        {
            if($_POST['d_national_id']!=$_POST['s_national_id'])
            {                
                $data['div_nid_error'] ='Not match!';
                echo CJSON::encode($data);
            }else{
                $data['div_nid_error'] ='';
                echo CJSON::encode($data);
            }
        }else{
            
        }
    }
}
