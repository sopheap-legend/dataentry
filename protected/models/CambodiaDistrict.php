<?php

/**
 * This is the model class for table "cambodia_district".
 *
 * The followings are the available columns in table 'cambodia_district':
 * @property string $district_code
 * @property string $district_name
 * @property integer $Province_code
 */
class CambodiaDistrict extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return 'cambodia_district';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('Province_code', 'required'),
                    array('Province_code', 'numerical', 'integerOnly'=>true),
                    array('district_name', 'length', 'max'=>50),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('district_code, district_name, Province_code', 'safe', 'on'=>'search'),
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
                    'district_code' => 'District Code',
                    'district_name' => 'District Name',
                    'Province_code' => 'Province Code',
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

            $criteria->compare('district_code',$this->district_code,true);
            $criteria->compare('district_name',$this->district_name,true);
            $criteria->compare('Province_code',$this->Province_code);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CambodiaDistrict the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /*public function get_combo_district()
    {
        $district = array();
        $sql="select district_code,district_name from cambodia_district order by 2";

        $command=Yii::app()->db->createCommand($sql);
        foreach($command->queryAll() as $row)
        {
            $district+=array($row['district_code']=>$row['district_name']);
        }

        $rst=array(''=>'');

        $rst+=$district;
        return $rst;
    }*/
    
    public function getDistrict($province_code,$district_code)
    {
        $select_form='';
        //$district_arr=array();
        $data= CambodiaDistrict::model()->findall('province_code=:province_code and district_code=:district_code',
                    array(
                            ':province_code'=>(int)$province_code,
                            ':district_code'=>(int)$district_code
                        )
                    );
        $data=CHtml::listData($data,'district_code','district_name');
        
        foreach($data as $value=>$name)
        {
            if($value==$district_code)
            {
                $select_form=$select_form. CHtml::tag('option',
                       array('value'=>$value,'selected'=>'selected'),CHtml::encode($name),true);
            }else{
                $select_form=$select_form. CHtml::tag('option',
                       array('value'=>$value),CHtml::encode($name),true);
            }
        }
        return $select_form;
    }
}
