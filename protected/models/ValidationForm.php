<?php
class ValidationForm extends CActiveRecord
{
    public $username;
    public $password;
    
    public function tableName()
    {
            return 'single_entry_profile';
    }
        
    public function rules()
    {
            return array(
                    // username and password are required
                    array('username', 'required'),
                    array('password', 'authenticate'),
            );
    }
    
    public function authenticate($attribute,$params)
    {
        if($this->password=='')
        {
            $this->addError('password','Pass is not null.');
        }
    }
}
?>

