<?php

/**
 * This is the model class for table "single_entry_profile".
 *
 * The followings are the available columns in table 'single_entry_profile':
 * @property string $file_id
 * @property string $title
 * @property string $fullname
 * @property string $national_id
 * @property integer $province_code
 * @property integer $district_code
 * @property integer $commune_code
 * @property integer $village_code
 * @property string $location
 * @property string $dob
 * @property string $msisdn
 * @property string $imsi
 * @property string $vendorid
 * @property string $state
 * @property string $last_update
 */
class SingleEntryProfile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $village_name;
        public $street_no;
        public $house_no;
        
	public function tableName()
	{
		return 'single_entry_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file_id, fullname, msisdn, imsi, vendorid', 'required'),
			array('province_code, district_code, commune_code, village_code,vendorid,imsi,msisdn', 'numerical', 'integerOnly'=>true),
			array('file_id', 'length', 'max'=>11),
			array('title', 'length', 'max'=>3),
			array('fullname, location', 'length', 'max'=>50),
			array('national_id', 'length', 'max'=>20),
                        array('imsi','length','min'=>4,'max'=>10),
			//array('dob', 'length', 'max'=>14),
                        array('dob','validatedob','length','min'=>4,'max'=>10),
                        array('msisdn,', 'length', 'min'=>8, 'max'=>9),
			array('last_update', 'length', 'max'=>15),
			array('vendorid', 'length', 'max'=>10),
			array('state', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('file_id, title, fullname, national_id, province_code, district_code, commune_code, village_code, location, dob, msisdn, imsi, vendorid, state, last_update', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'daily_input' => array(self::HAS_ONE, 'DailyFileInput', 'file_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'file_id' => 'File',
			'title' => 'Title',
			'fullname' => 'Customer Name',
			'national_id' => 'National',
			'province_code' => 'Province Code',
			'district_code' => 'District Code',
			'commune_code' => 'Commune Code',
			'village_code' => 'Village Code',
			'location' => 'Location',
			'dob' => 'Date of birth',
			'msisdn' => 'Telephone',
			'imsi' => 'Imsi',
			'vendorid' => 'Vendor ID',
			'state' => 'State',
			'last_update' => 'Last Update',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('file_id',$this->file_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('national_id',$this->national_id,true);
		$criteria->compare('province_code',$this->province_code);
		$criteria->compare('district_code',$this->district_code);
		$criteria->compare('commune_code',$this->commune_code);
		$criteria->compare('village_code',$this->village_code);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('msisdn',$this->msisdn,true);
		$criteria->compare('imsi',$this->imsi,true);
		$criteria->compare('vendorid',$this->vendorid,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('last_update',$this->last_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function check_valid_date($dob)
        {            
            $dob_arr  = explode('-', $dob);
            if(count($dob_arr)==1)
            {
                return 'YES';
            }elseif(count($dob_arr)==3)
            {
                if(strlen($dob)>8)
                {
                    if (checkdate($dob_arr[1], $dob_arr[2],$dob_arr[0])) {
                        return 'YES';
                    } else {
                        return 'NO';
                    }
                }else{
                    return 'NO';
                }
            }else{
                return 'NO';
            }
        } 

        public function validatedob($attribute,$params)
        {  
            //$chk='';
            //echo "bakou";
            if($this->dob!='')
            {   
                if(strlen($this->dob)<$params['min'])
                {
                    $this->addError('dob','Date input never less than 4 digit');
                }else{
                    $chk=$this->check_valid_date($this->dob);
                    if($chk=='NO')
                    {
                        $this->addError('dob','Date is not valid');
                    }
                }
            }
        }
        
        public function NationalIDList()
        {
            //$term = Yii::app()->request->getQuery('term');
            $criteria=new CDbCriteria;
            $criteria->condition = "national_id like '" . $_GET['term'] . "%'";

            $dataProvider = new CActiveDataProvider(get_class(CustomerInfo::model()), 
                    array(
                        'criteria'=>$criteria,)
                    );

            $cust_info = $dataProvider->getData(); 
            $return_array = array();
            foreach($cust_info as $info) {
                $return_array[] = array(
                            'label'=>$info->national_id,
                            'value'=>$info->national_id,
                            'id'=>$info->cust_id,
                            );
            }
            return $return_array;
        }
        
        public function update_batch_file($filename)
        {
            $sql="CALL pro_batch_file_control(:filename,@batch_id)";
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(':filename', $filename, PDO::PARAM_STR);
            $cmd->execute();
            
            return Yii::app()->db->createCommand("select @batch_id as result")->queryScalar(); 
        }
        
        public function count_unavaiable_file($filename)
        {
            $username=Yii::app()->user->name;
            $sql="select count(*) nrec from session where data like '%".$filename."%' and data not like '%".$username."%'";
            $cmd = Yii::app()->db->createCommand($sql);
            return $cmd->queryScalar(); 
        }
        
        public function daily_file_save($batch_file_id,$filename)
        {            
            $model= new DailyFileInput();
            
            $file_input = DailyFileInput::model()->find('file_name=:file_name',array(':file_name'=>$filename));
            if($file_input['file_id'] !='')
            {
                $file_id= $file_input['file_id'];
            }  else {
                $model->batch_file_id=$batch_file_id;
                $model->file_name=$filename;
                $model->save();

                $file_id= $model->file_id;
            } 
            
            return $file_id;
        }
        
        public function audit_log($file_id,$user_id,$flag,$reasion)
        {
            $model = new UserActionLog();
            $model->file_id=(int)$file_id;
            $model->user_id=(int)$user_id;
            $model->event_date=date("Y-m-d H:i:s");
            $model->flag=$flag;
            $model->reason=$reasion;
            return $model->save();
        }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SingleEntryProfile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
