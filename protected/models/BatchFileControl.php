<?php

/**
 * This is the model class for table "batch_file_control".
 *
 * The followings are the available columns in table 'batch_file_control':
 * @property string $batch_file_id
 * @property string $batch_file_name
 * @property integer $company_id
 * @property string $folder_path
 * @property string $event_date
 */
class BatchFileControl extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'batch_file_control';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('batch_file_name', 'required'),
			array('company_id', 'numerical', 'integerOnly'=>true),
			array('batch_file_name', 'length', 'max'=>30),
			array('folder_path', 'length', 'max'=>50),
			array('event_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('batch_file_id, batch_file_name, company_id, folder_path, event_date', 'safe', 'on'=>'search'),
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
			'batch_file_id' => 'Batch File',
			'batch_file_name' => 'Batch File Name',
			'company_id' => 'Company',
			'folder_path' => 'Folder Path',
			'event_date' => 'Event Date',
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

		$criteria->compare('batch_file_id',$this->batch_file_id,true);
		$criteria->compare('batch_file_name',$this->batch_file_name,true);
		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('folder_path',$this->folder_path,true);
		$criteria->compare('event_date',$this->event_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BatchFileControl the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
