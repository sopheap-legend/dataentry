<?php

/**
 * This is the model class for table "cambodia_village".
 *
 * The followings are the available columns in table 'cambodia_village':
 * @property integer $province_code
 * @property integer $district_code
 * @property integer $commune_code
 * @property string $village_code
 * @property string $village_name
 */
class CambodiaVillage extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return 'cambodia_village';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array(
                    array('province_code, district_code, commune_code', 'required'),
                    array('province_code, district_code, commune_code', 'numerical', 'integerOnly'=>true),
                    array('village_name', 'length', 'max'=>50),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array('province_code, district_code, commune_code, village_code, village_name', 'safe', 'on'=>'search'),
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
                    'village_code' => 'Village Code',
                    'village_name' => 'Village Name',
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
            $criteria->compare('commune_code',$this->commune_code);
            $criteria->compare('village_code',$this->village_code,true);
            $criteria->compare('village_name',$this->village_name,true);

            return new CActiveDataProvider($this, array(
                    'criteria'=>$criteria,
            ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CambodiaVillage the static model class
     */
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
    
    public function getVillage($province_code,$district_code,$commune_code,$village_code)
    {
        $select_form='';
        //$district_arr=array();
        $data= CambodiaVillage::model()->findall('province_code=:province_code 
                            and district_code=:district_code 
                            and commune_code=:commune_code
                            and village_code=:village_code',
                    array(
                            ':province_code'=>(int)$province_code,
                            ':district_code'=>(int)$district_code,
                            ':commune_code'=>(int)$commune_code,
                            ':village_code'=>(int)$village_code,
                        )
                    );
        $data=CHtml::listData($data,'village_code','village_name');
        
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
