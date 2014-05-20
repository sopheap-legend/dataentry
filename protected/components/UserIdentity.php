<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	
        private $_id;
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIV=4;
	const ERROR_STATUS_BAN=5;
    
        /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if (strpos($this->username,"@")) {
			$user= RbacUser::model()->findByAttributes(array('user_email'=>$this->username));
                        
		} else {
			$user=RbacUser::model()->findByAttributes(array('user_name'=>$this->username));
                        $ph=new PasswordHash(Yii::app()->params['phpass']['iteration_count_log2'], Yii::app()->params['phpass']['portable_hashes']);
		}
		if($user===null)
			if (strpos($this->username,"@")) {
				$this->errorCode=self::ERROR_EMAIL_INVALID;
			} else {
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
		//elseif(SHA1($this->password)!==$user->user_password) //using SHA1 encryption
                else if (!$ph->CheckPassword($this->password, $user->user_password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		//else if($user->status==0&&Yii::app()->getModule('user')->loginNotActiv==false)
		//	$this->errorCode=self::ERROR_STATUS_NOTACTIV;
		else if($user->status==0)
			$this->errorCode=self::ERROR_STATUS_BAN;
		else {
			$this->_id=$user->id;
			$this->username=$user->user_name; // title column as username
			$this->errorCode=self::ERROR_NONE;
                        /*
                        $sql="SELECT employee_id FROM v_employee_user WHERE user_id=:userId";
                        $command = Yii::app()->db->createCommand($sql);
                        $command->bindParam(":userId",$this->_id, PDO::PARAM_INT);
                        $employee = $command->execute();
                         * 
                        */
                       /*$employee_id= EmployeeUser::model()->find('user_id=:userId',array(':userId'=>$user->id));
                       
                       if(!$employee_id)
                       {
                           $employeeId=1;
                       }    
                       else
                       {
                           $employeeId=$employee_id->employee_id;
                       }
                        // Store employee ID in a session:
                        //$this->setState('employeeid',$employeeId);
                       Yii::app()->session['employeeid']=$employeeId;
                       Yii::app()->session['userid']=$user->id;
                       
                       $employee=Employee::model()->findByPk($employeeId);
                       Yii::app()->session['emp_fullname']= $employee->firstname . ' ' . $employee->lastname;*/
		}
		return !$this->errorCode;
	}
        
        /**
        * @return integer the ID of the user record
        */
	public function getId()
	{
		return $this->_id;
	}
}