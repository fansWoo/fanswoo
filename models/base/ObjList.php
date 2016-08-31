<?php

class ObjList extends ObjBase {

    public $obj_arr = [];
    public $child_value_arr = [];
    public $db_uniqueid = '';//填寫物件聯繫資料庫之唯一ID
    public $uniqueids_arr = [];//物件ID之陣列
    public $uniqueids = '';//物件ID之陣列字串組
    protected $db_where_arr = [];
    protected $db_name = '';
    protected $db_where_deletenull_bln;
    protected $model_name = '';
    protected $obj_class = '';
    protected $limitstart = 0;
    protected $limitcount = 1;

    public function __construct($arg = [])
    {
        if( empty($arg) )
        {
            return TRUE;
        }
        else if(
            isset( $arg['db_where_arr'] ) ||
            isset( $arg['db_orderby_arr'] ) ||
            isset( $arg['limitstart'] ) ||
            isset( $arg['limitcount'] )
        )
        {
            $this->construct_db($arg);
        }
        else if( !empty($arg) )
        {
            $this->construct($arg);
        }
    }
	
	public function construct($arg = [])
	{
        $construct_arr = !empty($arg['construct_arr']) ? $arg['construct_arr'] : array() ;
        $obj_class = !empty($arg['obj_class']) ? $arg['obj_class'] : array() ;
        $deletestatus_bln = isset($arg['deletestatus_bln']) && $arg['deletestatus_bln'] === TRUE ? TRUE : FALSE ;
        $deletelocale_bln = isset($arg['deletelocale_bln']) && $arg['deletelocale_bln'] === TRUE ? TRUE : FALSE ;
        
        if( empty($obj_class) )
        {
            $obj_class = $this->obj_class;
        }
        
        $model_Obj = new $obj_class;
        $db_uniqueid = $model_Obj->db_uniqueid;
        $this->db_uniqueid = $db_uniqueid;

        if(!empty($construct_arr))
        {
            foreach($construct_arr as $key => $value_arr)
            {
                $Model = new $obj_class;
                foreach($this->child_value_arr as $key2 => $value2)
                {
                    $Model->set($key2, $value2);
                }

                if($deletelocale_bln == TRUE)
                {
                    unset($value_arr['locale']);
                }
                else if( empty($value_arr['locale']) )
                {
                    if( isset( $model_Obj->locale ) )
                    {
                        $this->load->library('i18n');
                        $locale = $this->i18n->get_current_locale();
                        $value_arr['locale'] = $locale;
                    }
                }

                if($deletestatus_bln == TRUE)
                {
                    unset($value_arr['status']);
                }
                else if(empty($value_arr['status']))
                {
                    if( isset( $model_Obj->status ) )
                    {
                        $value_arr['status'] = 1;
                    }
                }

                $Model->construct($value_arr);
                $model_db_uniqueid = $Model->$db_uniqueid;
                $this->uniqueids_arr[] = $model_db_uniqueid;
                $db_objlist_key = $Model->db_objlist_key;
                if( !empty($Model->$db_objlist_key) )
                {
                    $this->obj_arr[$Model->$db_objlist_key] = $Model;
                }
                else if(!empty($model_db_uniqueid) && !is_numeric($model_db_uniqueid))
                {
                    $this->obj_arr[$model_db_uniqueid] = $Model;
                }
                else
                {
                    $this->obj_arr[] = $Model;
                }
            }
        }
        else
        {
            $this->obj_arr = array();
            $this->obj_arr[0] = new $obj_class;
            $this->obj_arr[0]->construct();
            $this->uniqueids_arr = array();
        }
        if(!empty($this->uniqueids_arr) && is_array($this->uniqueids_arr))
        {
            $this->uniqueids = implode(',', $this->uniqueids_arr);
        }
        
        return TRUE;
    }
    
	public function construct_db($arg = [])
    {
        $db_where_arr = !empty($arg['db_where_arr']) ? $arg['db_where_arr'] : array();
        $db_where_deletenull_bln = isset($arg['db_where_deletenull_bln']) && $arg['db_where_deletenull_bln'] === TRUE ? TRUE : FALSE ;
        $db_where_deletestatus_bln = isset($arg['db_where_deletestatus_bln']) && $arg['db_where_deletestatus_bln'] === TRUE ? TRUE : FALSE ;
        $db_where_deletelocale_bln = isset($arg['db_where_deletelocale_bln']) && $arg['db_where_deletelocale_bln'] === TRUE ? TRUE : FALSE ;
        $db_orderby_arr = !empty($arg['db_orderby_arr']) ? $arg['db_orderby_arr'] : array();
        $obj_class = !empty($arg['obj_class']) ? $arg['obj_class'] : '' ;
        $limitstart = !empty($arg['limitstart']) ? $arg['limitstart'] : 0;
        $limitcount = !empty($arg['limitcount']) ? $arg['limitcount'] : 0;
        $limitcount_max_bln = !empty($arg['limitcount_max_bln']) ? $arg['limitcount_max_bln'] : FALSE;
        
        $limitstart = !empty($limitstart) ? $limitstart : $this->limitstart ;
        $limitstart = is_numeric($limitstart) ? $limitstart : $this->limitstart;
        $limitcount = !empty($limitcount) ? $limitcount : $this->limitcount ;
        $limitcount = is_numeric($limitcount) ? $limitcount : $this->limitcount;

        //$model_name改名為obj_class，之後會刪除model_name，暫時先通用此變數
        if( !empty($model_name) && empty($obj_class) )
        {
            $obj_class = $model_name;
        }

        if( !empty( $arg['db_where_or_arr'] ) )
        {
            show_error('ObjList 不再支援 db_where_or_arr 引數，請使用新的寫法');
        }

        if( !empty( $arg['model_name'] ) )
        {
            show_error('ObjList 不再支援 model_name 引數，請使用 obj_class 作為代替');
        }

        if( !empty( $arg['db_where_like_arr'] ) )
        {
            show_error('ObjList 不再支援 db_where_like_arr 引數，請使用新的寫法');
        }
        
        $model_Obj = new $obj_class;
        $db_uniqueid = $model_Obj->db_uniqueid;
        $this->db_uniqueid = $db_uniqueid;

        //取得類別資料庫名稱
        if(!empty($model_Obj->db_name_arr))
        {
            $db_name = $model_Obj->db_name_arr[0];
        }
        else
        {
            $db_name = $model_Obj->db_name;
        }
        
        if($limitstart < 1)
        {
            $limitstart = 0;
        }
        
        if($limitcount > 100000000 && $limitcount_max_bln == FALSE)
        {
            $limitcount = 100000000;
        }

        if( is_array( $db_where_arr[0] ) && key( $db_where_arr[0] ) == 0)
        {
            $db_where_arr = $db_where_arr;
        }
        else
        {
            $db_where_arr = [$db_where_arr];
        }
        
        //若db_where_deletenull_bln為真，則刪除db_where_arr內為空值的搜尋條件
        if($db_where_deletenull_bln)
        {
            foreach($db_where_arr as $key => $value)
            {
                foreach($value as $key2 => $value2)
                {
                    if ( is_array($value2) ) {
                        // ec($value2);
                        foreach($value2 as $key3 => $value3)
                        {
                            if( empty( $value3 ) )
                            {
                                unset($db_where_arr[$key][$key2][$key3]);
                            }
                        }
                        if( empty( $db_where_arr[$key][$key2] ) )
                        {
                            unset($db_where_arr[$key][$key2]);
                        }
                    }
                    else if(empty($value2))
                    {
                        unset($db_where_arr[$key][$key2]);
                    }
                }
            }
        }

        //若「刪除空值」（$db_where_deletenull_bln）選項開啟，則讀取搜尋條件為空之資料表；若選項未開啟，且其它db_where搜尋條件皆為空值，則不讀取資料庫取值
        if(
            $db_where_deletenull_bln === FALSE &&
            empty($db_where_arr)
        )
        {
            $this->db_where_arr = $db_where_arr;
            $this->db_name = $db_name;
            $this->obj_class = $obj_class;
            $this->limitcount = $limitcount;
            $this->limitstart = $limitstart;

            $this->construct(array());
            return FALSE;
        }

        if($db_where_deletelocale_bln == TRUE)
        {
            foreach( $db_where_arr as $key => $value)
            {
                unset($db_where_arr[$key]['locale']);
            }
        }
        else if( isset( $model_Obj->locale ) )
        {
            foreach( $db_where_arr as $key => $value)
            {
                if( empty($db_where_arr[$key]['locale']) )
                {
                    $this->load->library('i18n');
                    $locale = $this->i18n->get_current_locale();
                    $db_where_arr[$key]['locale'] = $locale;
                }
            }
        }

        if($db_where_deletestatus_bln == TRUE)
        {
            foreach( $db_where_arr as $key => $value)
            {
                unset($db_where_arr[$key]['status']);
            }
        }
        else if( isset( $model_Obj->status ) )
        {
            foreach( $db_where_arr as $key => $value)
            {
                if( empty($db_where_arr[$key]['status']) )
                {
                    $db_where_arr[$key]['status'] = 1;
                }
            }
        }

        if(!empty($model_Obj->db_name_arr))
        {
            foreach($model_Obj->db_name_arr as $key => $value)
            {
                if($key == 0)
                {
                    $this->db->from($value);
                }
                else
                {
                    $this->db->join($value, $model_Obj->db_name_arr[0].'.'.$db_uniqueid.' = '.$value.'.'.$db_uniqueid, 'left');
                }
            }
        }
        else
        {
            $this->db->from($db_name);
        }

        foreach( (array) $db_where_arr as $key => $value_where_arr )
        {
            if( $key != 0)
            {
                $this->db->where('1 OR 1');
            }

            foreach( (array) $value_where_arr as $key_field => $value_field )
            {

                if(!empty($model_Obj->db_name_arr) && $key_field == 'status')
                {
                    $this->db->where($model_Obj->db_name_arr[0].'.'.$key_field, $value_field);
                }
                else if(is_array($value_field))
                {
                    if( substr( $key_field, -7, 7 ) == ' not in' )
                    {
                        $field_str = explode(' not in', $key_field)[0];
                        $this->db->where_not_in($field_str, $value_field);
                    }
                    else if( substr( $key_field, -3, 3 ) == ' in' )
                    {
                        $field_str = explode(' in', $key_field)[0];
                        $this->db->where_in($field_str, $value_field);
                    }
                }
                else
                {
                    if( substr( $key_field, -9, 9 ) == ' not like' )
                    {
                        $field_str = explode(' not like', $key_field)[0];
                        $this->db->not_like($field_str, $value_field);
                    }
                    else if( substr( $key_field, -5, 5 ) == ' like' )
                    {
                        $field_str = explode(' like', $key_field)[0];
                        $this->db->like($field_str, $value_field);
                    }
                    else if( substr( $key_field, -5, 5 ) == ' find' )
                    {
                        $field_str = explode(' find', $key_field)[0];
                        $this->db->where("FIND_IN_SET('$value_field', $field_str) != 0");
                    }
                    else
                    {
                        $this->db->where($key_field, $value_field);
                    }
                }

            }

        }


        if(!empty($db_orderby_arr))
        {
            if(is_array($db_orderby_arr) && !is_array($db_orderby_arr[0]) )
            {
                foreach($db_orderby_arr as $key => $value)
                {
                    if( !empty($value) && !empty($value[0]) && is_array($value) )
                    {
                        $field_implode = implode(", ", $value);
                        $this->db->order_by("field($key, $field_implode)", NULL, FALSE);
                    }
                    else if( !empty($key) && !empty($value) && !is_array($value) )
                    {
                        $this->db->order_by($key, $value);
                    }
                }
            }
        }

        $this->db->limit($limitcount, $limitstart);
        $query = $this->db->get();
        $construct_arr = $query->result_array();

        
        $this->db_where_arr = $db_where_arr;
        $this->db_name = $db_name;
        $this->db_where_deletenull_bln = $db_where_deletenull_bln;
        $this->obj_class = $obj_class;
        $this->limitcount = $limitcount;
        $this->limitstart = $limitstart;
        
        if(!empty($construct_arr))
        {
            $this->construct(array(
                'construct_arr' => $construct_arr
            ));
        }
    }

    public function set_child_value($arg)
    {
        $child_value_arr = !empty($arg['child_value_arr']) ? $arg['child_value_arr'] : array();
        $this->child_value_arr = $child_value_arr;
    }
    
    public function create_links($arg)
    {
        $base_url = !empty($arg['base_url']) ? $arg['base_url'] : '';
        
        $limitstart = $this->limitstart;
        $limitcount = $this->limitcount;
        $limitcount = !empty($limitcount) ? $limitcount : 0 ;

        if(strpos($base_url, '/?') > 0)
        {
            $base_url = $base_url.'&';
        }
        else
        {
            $base_url = $base_url.'/?';
        }
        
        $this->load->library('pagination');
        $config = array();
        $config['prev_tag_open'] = '<span class="prev">';
        $config['prev_tag_close'] = '</span>';
        $config['next_tag_open'] = '<span class="next">';
        $config['next_tag_close'] = '</span>';
        $config['first_tag_open'] = '<span class="first">';
        $config['first_tag_close'] = '</span>';
        $config['last_tag_open'] = '<span class="last">';
        $config['last_tag_close'] = '</span>';
        $config['base_url'] = $base_url.'limitcount='.$limitcount;
        $config['per_page'] = $limitcount;
        $config['total_rows'] = $this->get_maxcount();
        $this->pagination->initialize($config); 
        $links_Html = $this->pagination->create_links();
        
        return $links_Html;
    }
    
    public function get_maxcount()
    {
        $db_name = $this->db_name;
        $db_where_arr = $this->db_where_arr;

        $this->db->from($db_name);
        // $this->db->where($db_where_arr);
        
        return $this->db->get()->num_rows();
    }

    public function update()
    {
        $db_update_arr = $this->db_update_arr;

        foreach($this->obj_arr as $key => $value_Obj)
        {
            $value_Obj->update();
        }
    }
}