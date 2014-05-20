<?php
class DynamicSelectBox extends CModel
{
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }
        
    public function DynamicDistrict($province_code)
    {
        $tag='';
        $data= CambodiaDistrict::model()->findAll('province_code=:province_code',array(':province_code'=>(int)$province_code));
        $data=CHtml::listData($data,'district_code','district_name');

        $tag=$tag. "<option value=''>Select District</option>";
        foreach($data as $value=>$name)
        {
            $tag=$tag. CHtml::tag('option',
                       array('value'=>$value),CHtml::encode($name),true);
        }
        return $tag;
    }
}
?>
