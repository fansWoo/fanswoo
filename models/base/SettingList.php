<?php

class SettingList extends ObjList
{

    public function construct($arg = [])
    {
        parent::construct(array(
            'construct_arr' => $arg['construct_arr'],
            'obj_class' => 'Setting',
            'startcount' => 0,
            'limitcount' => 100
        ));
    }

    public function construct_db($arg = [])
    {
        $arg['obj_class'] = 'Setting';
        $arg['startcount'] = 0;
        $arg['limitcount'] = 100;
        
        parent::construct_db($arg);
    }

    public function get_array()
    {
        foreach($this->obj_arr as $key => $value_Setting)
        {
            $keyword = $value_Setting->keyword;
            $setting_arr[$keyword] = $value_Setting->value;
        }

        if(!empty($setting_arr))
        {
            return $setting_arr;
        }
        else
        {
            return array();
        }
    }

}