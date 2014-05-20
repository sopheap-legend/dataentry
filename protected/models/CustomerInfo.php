<?php

/**
 * This is the model class for table "customer_info".
 *
 * The followings are the available columns in table 'customer_info':
 * @property integer $cust_id
 * @property string $national_id
 * @property string $title
 * @property string $fullname
 * @property string $dob
 * @property integer $province_code
 * @property integer $district_code
 * @property integer $commune_code
 * @property integer $village_code
 * @property string $village_name
 * @property string $street_no
 * @property string $house_no
 */
class CustomerInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('province_code, district_code, commune_code, village_code', 'numerical', 'integerOnly'=>true),
			array('national_id', 'length', 'max'=>20),
			array('title', 'length', 'max'=>3),
			array('fullname, village_name', 'length', 'max'=>40),
			array('dob', 'length', 'max'=>10),
			array('street_no', 'length', 'max'=>25),
			array('house_no', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cust_id, national_id, title, fullname, dob, province_code, district_code, commune_code, village_code, village_name, street_no, house_no', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cust_id' => 'Cust',
			'national_id' => 'National',
			'title' => 'Title',
			'fullname' => 'Fullname',
			'dob' => 'Dob',
			'province_code' => 'Province Code',
			'district_code' => 'District Code',
			'commune_code' => 'Commune Code',
			'village_code' => 'Village Code',
			'village_name' => 'Village Name',
			'street_no' => 'Street No',
			'house_no' => 'House No',
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

		$criteria->compare('cust_id',$this->cust_id);
		$criteria->compare('national_id',$this->national_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('province_code',$this->province_code);
		$criteria->compare('district_code',$this->district_code);
		$criteria->compare('commune_code',$this->commune_code);
		$criteria->compare('village_code',$this->village_code);
		$criteria->compare('village_name',$this->village_name,true);
		$criteria->compare('street_no',$this->street_no,true);
		$criteria->compare('house_no',$this->house_no,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function get_customer_info($national_id)
        {
            $sql="SELECT cust_id,fullname,national_id,title,dob,province_code,province_name,district_code,district_name,
                    commune_code,commune_name,village_code,village,village_name,street_no,house_no
                    FROM v_customer_info
                    where national_id=:national_id";
            
            $cmd=Yii::app()->db->createCommand($sql);
            $cmd->bindParam(':national_id', $national_id, PDO::PARAM_STR);
            return $cmd->queryRow();
        }
}
