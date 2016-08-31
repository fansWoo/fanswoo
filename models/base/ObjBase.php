<?php

class ObjBase extends FS_Model {

    public function __construct($arg = [])
    {
        if( empty($arg) )
        {
            return TRUE;
        }
        else if( !empty($arg) )
        {
            $this->construct($arg);
        }
    }

    public function get($arg)
    {
        $name = $arg;
        return $this->$name;
    }

    //本set方法提供設置屬性值之功能，並提供ClassMetaList、PicObjList、DateTimeObj等簡易物件建構之方法，但其它未提及之方法或有內定值之屬性，應另外撰寫set__x()之方法設置屬性
    public function set($arg1, $arg2, $arg3 = NULL)
    {
        $name = $arg1;
        $value = $arg2;
        if($arg3 === 'DateTimeObj')
        {
            //引入引數並將空值的變數給予空值
            reset_null_arr($arg2, ['datetime', 'inputtime_date', 'inputtime_time']);
            foreach($arg2 as $key => $value) ${$key} = $arg2[$key];

            //建立DateTime物件
            $value = new DateTimeObj(array(
                'datetime' => $datetime,
                'inputtime_date' => $inputtime_date,
                'inputtime_time' => $inputtime_time
            ));
        }
        else if($arg3 === 'ClassMetaList')
        {
            //引入引數並將空值的變數給予空值
            reset_null_arr($arg2, ['classids', 'classids_arr']);
            foreach($arg2 as $key => $value) ${$key} = $arg2[$key];

            //建立ClassMetaList物件
            check_comma_array($classids, $classids_arr);
            $value = new ObjList();
            $value->construct_db(array(
                'db_where_arr' => array(
                    'classid in' => $classids_arr
                ),
                'db_orderby_arr' => [
                    'classid' => $classids_arr
                ],
                'obj_class' => 'ClassMeta',
                'limitstart' => 0,
                'limitcount' => 100
            ));
            // pre($value);
        }
        else if($arg3 === 'PicObjList')
        {
            //引入引數並將空值的變數給予空值
            reset_null_arr($arg2, ['picids', 'picids_arr']);
            foreach($arg2 as $key => $value) ${$key} = $arg2[$key];

            //建立PicObjList物件
            check_comma_array($picids, $picids_arr);
            $value = new ObjList();
            $value->construct_db(array(
                'db_where_arr' => array(
                    'picid in' => $picids_arr
                ),
                'obj_class' => 'PicObj',
                'db_orderby_arr' => [
                    'picid' => $picids_arr
                ],
                'limitstart' => 0,
                'limitcount' => 100
            ));
        }

        if($value === NULL)
        {
            return FALSE;
        }
        else if($value === FALSE)
        {
            $this->$name = FALSE;
            return FALSE;
        }
        else if($value === '')
        {
            $this->$name = '';
            return FALSE;
        }
        else if($value === 0)
        {
            $this->$name = 0;
            return $this->$name;
        }
        else
        {
            $this->$name = $value;
            return $this->$name;
        }
    }

    public function get_called_class()
    {
        return get_called_class();
    }
	
}