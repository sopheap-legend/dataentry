<?php

/**
 * This is the model class for table "cambodia_commune".
 *
 * The followings are the available columns in table 'cambodia_commune':
 * @property integer $province_code
 * @property integer $district_code
 * @property string $commune_code
 * @property string $commune_name
 */
class CambodiaCommune extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cambodia_commune';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('province_code, district_code', 'required'),
			array('province_code, district_code', 'numerical', 'integerOnly'=>true),
			array('commune_name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('province_code, district_code, commune_code, commune_name', 'safe', 'on'=>'search'),
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
			'province_code' => 'Province Code',
			'district_code' => 'District Code',
			'commune_code' => 'Commune Code',
			'commune_name' => 'Commune Name',
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

		$criteria->compare('province_code',$this->province_code);
		$criteria->compare('district_code',$this->district_code);
		$criteria->compare('commune_code',$this->commune_code,true);
		$criteria->compare('commune_name',$this->commune_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CambodiaCommune the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
