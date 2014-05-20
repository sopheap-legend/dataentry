<?php
class ValidationFormController extends Controller
{
    public function actionTest()
    {
        $model = new ValidationForm();
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }
        
        $this->render('login',array('model'=>$model));
    }
}
?>
