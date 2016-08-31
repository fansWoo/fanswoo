<?php

class ClassMetaList extends ObjList
{
    public $child_model_arr = [];
    public $construct_db_arg_arr = [];

    public function construct($arg = [])
    {
        $construct_arr = !empty($arg['construct_arr']) ? $arg['construct_arr'] : array() ;
        $child_model_arr = !empty($arg['child_model_arr']) ? $arg['child_model_arr'] : array() ;
        $child_classids = !empty($arg['child_classids']) ? $arg['child_classids'] : '' ;

        $child_model_arr = $this->child_model_arr;
        $child_classids = $this->child_classids;

        parent::construct(array(
            'construct_arr' => $arg['construct_arr'],
            'obj_class' => 'ClassMeta',
            'startcount' => 0,
            'limitcount' => 100
        ));

        foreach($this->obj_arr as $key => $value_ClassMeta)
        {
            //載入頁籤
            $ClassMetaList = new ClassMetaList();
            $ClassMetaList->set_child_value([
                'child_value_arr' => [
                    'construct_class_bln' => FALSE
                ]
            ]);

            $construct_db_arg_arr = $this->construct_db_arg_arr;
            $construct_db_arg_arr['obj_class'] = 'ClassMeta';
            $construct_db_arg_arr['db_where_arr'] = [];
            $construct_db_arg_arr['db_where_arr']['classids'] = $value_ClassMeta->classid;
            $construct_db_arg_arr['child_model_arr'] = $child_model_arr;
            $construct_db_arg_arr['child_classids'] = $child_classids;

            // echoe($construct_db_arg_arr);

            $ClassMetaList->construct_db($construct_db_arg_arr);
            if(empty($ClassMetaList->obj_arr))
            {
                $child_model_arr['db_where_arr'][$child_classids] = $value_ClassMeta->classid;
                $ObjList = new ObjList();
                $ObjList->set_child_value([
                    'child_value_arr' => [
                        'construct_class_bln' => FALSE
                    ]
                ]);
                $ObjList->construct_db(
                    $child_model_arr
                );
                $this->obj_arr[$key]->ObjList = $ObjList;
                // pre($ObjList);
            }
            else
            {
                $this->obj_arr[$key]->ObjList = $ClassMetaList;
                // pre($ClassMetaList);
            }
        }
    }

    public function construct_db($arg)
    {
        $db_where_arr = !empty($arg['db_where_arr']) ? $arg['db_where_arr'] : array() ;
        $child_model_arr = !empty($arg['child_model_arr']) ? $arg['child_model_arr'] : array() ;
        $child_classids = !empty($arg['child_classids']) ? $arg['child_classids'] : '' ;

        $this->construct_db_arg_arr = $arg;

        $this->child_model_arr = $child_model_arr;
        $this->child_classids = $child_classids;

        $this->set_child_value([
            'child_value_arr' => [
                'construct_class_bln' => FALSE
            ]
        ]);

        $arg['obj_class'] = 'ClassMeta';

        parent::construct_db($arg);
    }

    public function get_array()
    {
    }

}