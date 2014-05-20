<?php
class validatedob extends CValidator
{
    protected function validateAttribute($object,$attribute)
    {            
        $this->addError($attribute,'Incorrect Date of birth');
    }
}
?>
