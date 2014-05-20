<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property integer $id
 * @property string $emp_number
 * @property string $lastname
 * @property string $firstname
 * @property string $middle_name
 * @property string $nick_name
 * @property integer $smoker
 * @property string $ethnic_race_code
 * @property string $birthday
 * @property integer $nation_code
 * @property integer $gender
 * @property string $marital_status
 * @property string $ssn_num
 * @property string $sin_num
 * @property string $other_id
 * @property string $dri_lice_num
 * @property string $dri_lice_exp_date
 * @property string $military_service
 * @property integer $employment_status_id
 * @property integer $job_title_id
 * @property integer $eeo_cat_code
 * @property integer $work_station
 * @property string $street1
 * @property string $street2
 * @property string $city_code
 * @property string $country_code
 * @property integer $province_id
 * @property string $zipcode
 * @property string $hm_telephone
 * @property string $mobile
 * @property string $work_telephone
 * @property string $work_email
 * @property string $sal_grd_code
 * @property string $joined_date
 * @property string $other_email
 * @property integer $termination_id
 * @property string $custom1
 * @property string $custom2
 * @property string $custom3
 * @property string $custom4
 * @property string $custom5
 * @property string $custom6
 * @property string $custom7
 * @property string $custom8
 * @property string $custom9
 * @property string $custom10
 */
class Employee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, smoker, nation_code, gender, employment_status_id, job_title_id, eeo_cat_code, work_station, province_id, termination_id', 'numerical', 'integerOnly'=>true),
			array('emp_number, hm_telephone, mobile, work_telephone, work_email, other_email', 'length', 'max'=>50),
			array('lastname, firstname, middle_name, nick_name, ssn_num, sin_num, other_id, dri_lice_num, military_service, street1, street2, city_code', 'length', 'max'=>100),
			array('ethnic_race_code, sal_grd_code', 'length', 'max'=>13),
			array('marital_status, zipcode', 'length', 'max'=>20),
			array('country_code', 'length', 'max'=>3),
			array('custom1, custom2, custom3, custom4, custom5, custom6, custom7, custom8, custom9, custom10', 'length', 'max'=>250),
			array('birthday, dri_lice_exp_date, joined_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_number, lastname, firstname, middle_name, nick_name, smoker, ethnic_race_code, birthday, nation_code, gender, marital_status, ssn_num, sin_num, other_id, dri_lice_num, dri_lice_exp_date, military_service, employment_status_id, job_title_id, eeo_cat_code, work_station, street1, street2, city_code, country_code, province_id, zipcode, hm_telephone, mobile, work_telephone, work_email, sal_grd_code, joined_date, other_email, termination_id, custom1, custom2, custom3, custom4, custom5, custom6, custom7, custom8, custom9, custom10', 'safe', 'on'=>'search'),
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
                    'user' => array(self::BELONGS_TO, 'RbacUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'emp_number' => 'Emp Number',
			'lastname' => 'Lastname',
			'firstname' => 'Firstname',
			'middle_name' => 'Middle Name',
			'nick_name' => 'Nick Name',
			'smoker' => 'Smoker',
			'ethnic_race_code' => 'Ethnic Race Code',
			'birthday' => 'Birthday',
			'nation_code' => 'Nation Code',
			'gender' => 'Gender',
			'marital_status' => 'Marital Status',
			'ssn_num' => 'Ssn Num',
			'sin_num' => 'Sin Num',
			'other_id' => 'Other',
			'dri_lice_num' => 'Dri Lice Num',
			'dri_lice_exp_date' => 'Dri Lice Exp Date',
			'military_service' => 'Military Service',
			'employment_status_id' => 'Employment Status',
			'job_title_id' => 'Job Title',
			'eeo_cat_code' => 'Eeo Cat Code',
			'work_station' => 'Work Station',
			'street1' => 'Street1',
			'street2' => 'Street2',
			'city_code' => 'City Code',
			'country_code' => 'Country Code',
			'province_id' => 'Province',
			'zipcode' => 'Zipcode',
			'hm_telephone' => 'Hm Telephone',
			'mobile' => 'Mobile',
			'work_telephone' => 'Work Telephone',
			'work_email' => 'Work Email',
			'sal_grd_code' => 'Sal Grd Code',
			'joined_date' => 'Joined Date',
			'other_email' => 'Other Email',
			'termination_id' => 'Termination',
			'custom1' => 'Custom1',
			'custom2' => 'Custom2',
			'custom3' => 'Custom3',
			'custom4' => 'Custom4',
			'custom5' => 'Custom5',
			'custom6' => 'Custom6',
			'custom7' => 'Custom7',
			'custom8' => 'Custom8',
			'custom9' => 'Custom9',
			'custom10' => 'Custom10',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('emp_number',$this->emp_number,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('nick_name',$this->nick_name,true);
		$criteria->compare('smoker',$this->smoker);
		$criteria->compare('ethnic_race_code',$this->ethnic_race_code,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('nation_code',$this->nation_code);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('marital_status',$this->marital_status,true);
		$criteria->compare('ssn_num',$this->ssn_num,true);
		$criteria->compare('sin_num',$this->sin_num,true);
		$criteria->compare('other_id',$this->other_id,true);
		$criteria->compare('dri_lice_num',$this->dri_lice_num,true);
		$criteria->compare('dri_lice_exp_date',$this->dri_lice_exp_date,true);
		$criteria->compare('military_service',$this->military_service,true);
		$criteria->compare('employment_status_id',$this->employment_status_id);
		$criteria->compare('job_title_id',$this->job_title_id);
		$criteria->compare('eeo_cat_code',$this->eeo_cat_code);
		$criteria->compare('work_station',$this->work_station);
		$criteria->compare('street1',$this->street1,true);
		$criteria->compare('street2',$this->street2,true);
		$criteria->compare('city_code',$this->city_code,true);
		$criteria->compare('country_code',$this->country_code,true);
		$criteria->compare('province_id',$this->province_id);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('hm_telephone',$this->hm_telephone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('work_telephone',$this->work_telephone,true);
		$criteria->compare('work_email',$this->work_email,true);
		$criteria->compare('sal_grd_code',$this->sal_grd_code,true);
		$criteria->compare('joined_date',$this->joined_date,true);
		$criteria->compare('other_email',$this->other_email,true);
		$criteria->compare('termination_id',$this->termination_id);
		$criteria->compare('custom1',$this->custom1,true);
		$criteria->compare('custom2',$this->custom2,true);
		$criteria->compare('custom3',$this->custom3,true);
		$criteria->compare('custom4',$this->custom4,true);
		$criteria->compare('custom5',$this->custom5,true);
		$criteria->compare('custom6',$this->custom6,true);
		$criteria->compare('custom7',$this->custom7,true);
		$criteria->compare('custom8',$this->custom8,true);
		$criteria->compare('custom9',$this->custom9,true);
		$criteria->compare('custom10',$this->custom10,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
