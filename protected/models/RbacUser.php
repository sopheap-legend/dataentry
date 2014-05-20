<?php

/**
 * This is the model class for table "rbac_user".
 *
 * The followings are the available columns in table 'rbac_user':
 * @property integer $id
 * @property string $user_name
 * @property integer $group_id
 * @property string $user_password
 * @property integer $deleted
 * @property integer $status
 * @property string $date_entered
 * @property string $modified_date
 * @property integer $created_by
 */
class RbacUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'rbac_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, group_id, user_password', 'required'),
			array('id, group_id, deleted, status, created_by', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>60),
			array('user_password', 'length', 'max'=>128),
			array('date_entered, modified_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_name, group_id, user_password, deleted, status, date_entered, modified_date, created_by', 'safe', 'on'=>'search'),
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
			'Employees' => array(self::HAS_MANY, 'HrEmployee', 'user_id'),
			//'rbacPages' => array(self::MANY_MANY, 'RbacPage', 'rbac_page_user(user_id, page_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_name' => 'User Name',
			'group_id' => 'Group',
			'user_password' => 'User Password',
			'deleted' => 'Deleted',
			'status' => 'Status',
			'date_entered' => 'Date Entered',
			'modified_date' => 'Modified Date',
			'created_by' => 'Created By',
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
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('deleted',$this->deleted);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_entered',$this->date_entered,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('created_by',$this->created_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RbacUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
