<?php

class ClassMetaList extends ObjList
{
    public $child_model_Arr = [];
    public $construct_db_arg_Arr = [];

    public function construct($arg)
    {
        $construct_Arr = !empty($arg['construct_Arr']) ? $arg['construct_Arr'] : array() ;
        $child_model_Arr = !empty($arg['child_model_Arr']) ? $arg['child_model_Arr'] : array() ;
        $child_classids_Str = !empty($arg['child_classids_Str']) ? $arg['child_classids_Str'] : '' ;

        $child_model_Arr = $this->child_model_Arr;
        $child_classids_Str = $this->child_classids_Str;

        parent::construct(array(
            'construct_Arr' => $arg['construct_Arr'],
            'model_name_Str' => 'ClassMeta',
            'startcount_Num' => 0,
            'limitcount_Num' => 100
        ));

        foreach($this->obj_Arr as $key => $value_ClassMeta)
        {
            //載入頁籤
            $ClassMetaList = new ClassMetaList();
            $ClassMetaList->set_child_value([
                'child_value_Arr' => [
                    'construct_class_Bln' => FALSE
                ]
            ]);

            $construct_db_arg_Arr = $this->construct_db_arg_Arr;
            $construct_db_arg_Arr['model_name_Str'] = 'ClassMeta';
            $construct_db_arg_Arr['db_where_Arr'] = [];
            $construct_db_arg_Arr['db_where_Arr']['classids'] = $value_ClassMeta->classid_Num;
            $construct_db_arg_Arr['child_model_Arr'] = $child_model_Arr;
            $construct_db_arg_Arr['child_classids_Str'] = $child_classids_Str;

            // echoe($construct_db_arg_Arr);

            $ClassMetaList->construct_db($construct_db_arg_Arr);
            if(empty($ClassMetaList->obj_Arr))
            {
                $child_model_Arr['db_where_Arr'][$child_classids_Str] = $value_ClassMeta->classid_Num;
                $ObjList = new ObjList();
                $ObjList->set_child_value([
                    'child_value_Arr' => [
                        'construct_class_Bln' => FALSE
                    ]
                ]);
                $ObjList->construct_db(
                    $child_model_Arr
                );
                $this->obj_Arr[$key]->ObjList = $ObjList;
                // pre($ObjList);
            }
            else
            {
                $this->obj_Arr[$key]->ObjList = $ClassMetaList;
                // pre($ClassMetaList);
            }
        }
    }

    public function construct_db($arg)
    {
        $db_where_Arr = !empty($arg['db_where_Arr']) ? $arg['db_where_Arr'] : array() ;
        $child_model_Arr = !empty($arg['child_model_Arr']) ? $arg['child_model_Arr'] : array() ;
        $child_classids_Str = !empty($arg['child_classids_Str']) ? $arg['child_classids_Str'] : '' ;

        $this->construct_db_arg_Arr = $arg;

        $this->child_model_Arr = $child_model_Arr;
        $this->child_classids_Str = $child_classids_Str;

        $this->set_child_value([
            'child_value_Arr' => [
                'construct_class_Bln' => FALSE
            ]
        ]);

        $arg['model_name_Str'] = 'ClassMeta';

        parent::construct_db($arg);
    }

    public function get_array()
    {
    }

}