<?php

class ObjDbBase extends ObjBase {

    public $status = 1;
    public $db_name_arr = array();//填寫物件聯繫資料庫之陣列
    public $db_uniqueid = '';//填寫物件聯繫資料庫之唯一ID

    public function __construct($arg = [])
    {

        if( empty($arg) )
        {
            return TRUE;
        }
        else if(
            !empty( $arg['db_where_arr'] )
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

    }
    
    public function construct_db($arg = [])
    {
        $db_where_arr = !empty($arg['db_where_arr']) ? $arg['db_where_arr'] : array();
        $db_where_deletenull_bln = isset($arg['db_where_deletenull_bln']) && $arg['db_where_deletenull_bln'] !== TRUE ? FALSE : TRUE ;
        $db_where_deletestatus_bln = isset($arg['db_where_deletestatus_bln']) && $arg['db_where_deletestatus_bln'] === TRUE ? TRUE : FALSE ;
        $db_orderby_arr = !empty($arg['db_orderby_arr']) ? $arg['db_orderby_arr'] : array();
        $db_name_arr = $this->db_name_arr;
        $db_uniqueid = $this->db_uniqueid;

        if( !empty( $this->db_name ) )
        {
            show_error('ObjList 不再支援 db_name 引數，請使用 db_name_arr[0] 代替');
        }
        $db_name = $this->db_name_arr[0];


        //若db_where_deletenull_bln為真，則讓空值可通過db_where_arr內為空值的搜尋條件
        if($db_where_deletenull_bln)
        {
            foreach($db_where_arr as $key => $value)
            {
                if(empty($value))
                {
                    unset($db_where_arr[$key]);
                }
            }
        }
        else
        {
            $db_where_arr2 = $db_where_arr;
            foreach($db_where_arr as $key => $value)
            {
                if(empty($value))
                {
                    $db_where_arr2[$key] = '';
                }
            }
            $db_where_arr = $db_where_arr2;
        }

        if(empty($db_where_arr))
        {
            return FALSE;
        }
        
        if($db_where_deletestatus_bln == TRUE)
        {
            unset($db_where_arr['status']);
        }
        else if(empty($db_where_arr['status']))
        {
            $db_where_arr['status'] = 1;
        }

        if(!empty($db_name_arr))
        {
            //如果沒有fs_usr_field_shop的話就創建一個資料庫
            $db_uniqueid_value = $db_where_arr[$db_name_arr[0].'.'.$db_uniqueid];
            if(empty($db_uniqueid_value))
            {
                $this->db->from($db_name_arr[0]);
                $this->db->where($db_where_arr);
                $query = $this->db->get();
                $db_arr = $query->row_array();
                $db_uniqueid_value = $db_arr[$db_uniqueid];
                if(empty($db_uniqueid_value))
                {
                    return FALSE;
                }
            }
            foreach($db_name_arr as $key => $value)
            {
                $this->db->from($value);
                $this->db->where($db_uniqueid, $db_uniqueid_value);
                $query = $this->db->get();
                    
                if($query->num_rows() == 0)
                {
                    $this->db->insert($value, array($db_uniqueid => $db_uniqueid_value));
                }
            }
            foreach($db_name_arr as $key => $value)
            {
                if($key == 0)
                {
                    $this->db->from($value);
                }
                else
                {
                    $this->db->join($value, $db_name_arr[0].'.'.$db_uniqueid.' = '.$value.'.'.$db_uniqueid, 'left');
                }
            }
        }
        else
        {
            $this->db->from($db_name_arr[0]);
        }
        
        if(!empty($db_where_arr))
        {
            if(!empty($db_name_arr))
            {
                $db_where_arr2 = $db_where_arr;
                $db_where_arr = array();
                foreach($db_where_arr2 as $key => $value)
                {
                    $db_where_arr[$key] = $value;
                }
                $this->db->where($db_where_arr);
            }
            else
            {
                $this->db->where($db_where_arr);
            }
        }

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

        $query = $this->db->get();
        $construct_arr = $query->row_array();
        
        $this->construct(nokey_to_typekey($construct_arr));
    }
    
    protected function get_db_field()
    {
        $db_field_to_this_arr = $this->db_field_arr;
        
        foreach( (array) $db_field_to_this_arr as $key => $value)
        {
            if( is_array($value) )
            {
                if( !empty($value) )
                {
                    $db_field_arr[$key] = $this->{$value[0]}->{$value[1]};
                }
                else
                {
                    $db_field_arr[$key] = '';
                }
            }
            else
            {
                if( !empty($value) )
                {
                    $db_field_arr[$key] = $this->$value;
                }
                else
                {
                    $db_field_arr[$key] = '';
                }
            }
        }
        
        return $db_field_arr;
    }

    public function reset_uniqueid()
    {
        $db_uniqueid = $this->db_uniqueid;
        $db_name_arr = $this->db_name_arr;

        $db_uniqueid2 = $db_uniqueid.'';

        if(empty($this->$db_uniqueid2))
        {
            if(!empty($db_name_arr))
            {
                $db_uniqueid_num = db_search_max(array(
                    'table_name' => $db_name_arr[0],
                    'id_name' => $db_uniqueid
                )) + 1;
            }
            else
            {
                $db_uniqueid_num = db_search_max(array(
                    'table_name' => $db_name_arr[0],
                    'id_name' => $db_uniqueid
                )) + 1;
            }

            $this->db_uniqueid_num = $db_uniqueid_num;
        }
    }
    
    //將物件資料更新至資料庫
    public function update($arg = [])
    {
        $db_update_arr = !empty($arg['db_update_arr']) ? $arg['db_update_arr'] : [];
        
        if(!empty($db_update_arr['status']))
        {
            unset($db_update_arr['status']);
        }

        $db_uniqueid = $this->db_uniqueid;
        $db_name_arr = $this->db_name_arr;
        
        if(count($db_name_arr) >= 2)
        {
            $db_uniqueid_dbname = $db_name_arr[0].'.'.$db_uniqueid;
        }
        else
        {
            $db_uniqueid_dbname = $db_uniqueid;
        }

        $db_field_arr = $this->get_db_field();

        if(empty($db_field_arr[$db_uniqueid_dbname]))
        {
            $insert_or_update = 'insert';
        }
        else
        {
            $insert_or_update = 'update';
        }

        if($insert_or_update == 'insert')
        {
            if(count($db_name_arr) >= 2)
            {
                foreach($db_name_arr as $key => $value)
                {
                    $db_field_arr2 = array();
                    if( !empty( $this->$db_uniqueid ) )
                    {
                        $db_field_arr[$db_uniqueid] = $this->$db_uniqueid;
                    }
                    foreach($db_field_arr as $key2 => $value2)
                    {
                        $key_string_arr = explode('.', $key2);
                        if($key_string_arr[0] == $value)
                        {
                            $key_string = $key_string_arr[1];
                            $db_field_arr2[$key_string] = $db_field_arr[$key2];
                        }
                    }
                    $this->db->insert($db_name_arr[$key], $db_field_arr2);
                    $this->$db_uniqueid = $this->db->insert_id();
                }
            }
            else
            {
                $db_field_arr['status'] = 1;
                $db_uniqueid = $db_uniqueid.'';
                $this->db->insert($db_name_arr[0], $db_field_arr);
                $this->$db_uniqueid = $this->db->insert_id();
            }
        }
        else if( $insert_or_update == 'update' )
        {
            if(count($db_name_arr) >= 2)
            {
                //如果有選擇更新的欄位資料，則針對選擇的欄位做篩選
                if(!empty($db_update_arr))
                {
                    foreach($db_field_arr as $key => $value)
                    {
                        if(!in_array($key, $db_update_arr) && $key !== $db_uniqueid_dbname)
                        {
                            unset($db_field_arr[$key]);
                        }
                    }
                }
                foreach($db_name_arr as $key => $value)
                {
                    //先檢查有沒有這個 where ，如果存在就 update ，否則就 insert
                    $db_field_arr2 = array();

                    $this->db->where($db_uniqueid, $this->$db_uniqueid);
                    $query = $this->db->get( $db_name_arr[$key] );
                    $arr = $query->row_array();

                    if( !empty( $arr ) )
                    {
                        foreach($db_field_arr as $key2 => $value2)
                        {
                            $key_string_arr = explode('.', $key2);
                            if($key_string_arr[0] == $value || $key_string_arr[1] == $db_uniqueid)
                            {
                                $key_string = $key_string_arr[1];
                                $db_field_arr2[$key_string] = $value2;
                            }
                        }
                        $this->db->where($db_uniqueid, $db_field_arr2[$db_uniqueid]);
                        $this->db->update($db_name_arr[$key], $db_field_arr2);
                    }
                    else
                    {
                        foreach($db_field_arr as $key2 => $value2)
                        {
                            $key_string_arr = explode('.', $key2);
                            if($key_string_arr[0] == $value)
                            {
                                $key_string = $key_string_arr[1];
                                $db_field_arr2[$key_string] = $db_field_arr[$key2];
                            }
                        }
                        $db_field_arr2[$db_uniqueid] = $this->$db_uniqueid;
                        $this->db->insert($db_name_arr[$key], $db_field_arr2);
                        $this->$db_uniqueid = $this->db->insert_id();
                    }
                }
            }
            else
            {
                if(!empty($db_update_arr))
                {
                    foreach($db_field_arr as $key => $value)
                    {
                        if(!in_array($key, $db_update_arr) && $key !== $db_uniqueid)
                        {
                            unset($db_field_arr[$key]);
                        }
                    }
                }
                $db_field_arr['status'] = 1;
                $this->db->where(array($db_uniqueid => $db_field_arr[$db_uniqueid]));
                $this->db->update($db_name_arr[0], $db_field_arr);
            }
        }
    }

    public function set__status($arg)
    {
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['status']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        if(empty($status))
        {
            $status = 1;
        }

        $this->status = $status;
    }

    public function set__locale($arg)
    {

        if(empty($arg['locale']))
        {
            $this->load->library('i18n');
            $locale = $this->i18n->get_current_locale();
        }
        else
        {
            $locale = $arg['locale'];
        }

        $this->locale = $locale;
    }

    public function set__uid($arg)
    {
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['uid']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];

        //若uid為空則以登入者uid作為本物件之預設uid
        if(empty($uid))
        {
            $data['user'] = get_user();
            $uid = $data['user']['uid'];
        }

        $this->uid = $uid;
    }

    public function set__uid_User($arg)
    {
        $uid = $arg['uid'];
        $email = $arg['email'];

        //若uid和email都為空則以登入者uid作為本物件之預設uid
        if( !empty($email) )
        {
            $User = new User([
                'db_where_arr' => [
                    'email' => $email
                ]
            ]);
        }
        else
        {
            if( empty($uid) )
            {
                $data['user'] = get_user();
                $uid = $data['user']['uid'];
            }

            $User = new User([
                'db_where_arr' => [
                    'uid' => $uid
                ]
            ]);
        }

        $this->uid_User = $User;

    }

    public function set__slug($arg)
    {
        //引入引數並將空值的變數給予空值
        reset_null_arr($arg, ['slug']);
        foreach($arg as $key => $value) ${$key} = $arg[$key];
        
        if(empty($slug) || !preg_match("/^([0-9A-Za-z()_-]+)$/", $slug))
        {
            $slug = substr(md5('FANSWOO'.rand(10000000, 99999999)),0,8);
        }

        $this->reset_uniqueid();
        $db_uniqueid_num = $this->db_uniqueid.'';

        //計算唯一值，否則自動增加+(1)字串
        $class_slug_bln = FALSE;
        while($class_slug_bln === FALSE)
        {
            $this->db->from($this->db_name_arr[0]);
            $this->db->where([
                $this->db_uniqueid.' !=' => $this->$db_uniqueid_num,
                'slug' => $slug
            ]);
            $query = $this->db->get();
            $class_arr = $query->row_array();
            if(empty($class_arr))
            {
                $class_slug_bln = TRUE;
            }
            else
            {
                $slug = $slug.'(1)';
            }
        }

        $this->slug = $slug;
    }
    
    //資料status屬性為紀錄該筆物件之狀態
    //status=-1為刪除
    //status=0為建構中
    //status=1為正常啟用
    //status=2為隱藏

    //復原這筆資料，將資料狀態改為1
    public function recovery()
    {
        $db_uniqueid = $this->db_uniqueid;
        $db_name_arr = $this->db_name_arr;

        $db_uniqueid = $db_uniqueid.'';
        $db_uniqueid_num = $this->$db_uniqueid;

        $this->db->where(array(
            $db_uniqueid => $db_uniqueid_num
        ));
        $this->db->update($db_name_arr[0], array('status' => 1) ); 
    }

    //隱藏這筆資料，將資料狀態改為2
    public function hidden()
    {
        $db_uniqueid = $this->db_uniqueid;
        $db_name_arr = $this->db_name_arr;

        $db_uniqueid = $db_uniqueid.'';
        $db_uniqueid_num = $this->$db_uniqueid;

        $this->db->where(array(
            $db_uniqueid => $db_uniqueid_num
        ));
        $this->db->update($db_name_arr[0], array('status' => 2) ); 
    }

    //刪除這筆資料，將資料狀態改為-1
    public function delete()
    {
        $db_uniqueid = $this->db_uniqueid;
        $db_name_arr = $this->db_name_arr;

        $db_uniqueid = $db_uniqueid.'';
        $db_uniqueid_num = $this->$db_uniqueid;

        $this->db->where(array(
            $db_uniqueid => $db_uniqueid_num
        ));
        $this->db->update($db_name_arr[0], array('status' => -1) ); 
    }

    //永久銷毀這筆資料
    public function destroy()
    {
        $db_uniqueid = $this->db_uniqueid;
        $db_name_arr = $this->db_name_arr;

        $db_uniqueid = $db_uniqueid.'';
        $db_uniqueid_num = $this->$db_uniqueid;

        foreach( $db_name_arr as $key => $value)
        {
            $this->db->where(array(
                $db_uniqueid => $db_uniqueid_num
            ));
            $this->db->delete($db_name_arr[$key]);
        }
    }

    //永久銷毀這筆資(繼承的資料表)
    public function destroy2()
    {
        show_error('請使用 destroy 方法，本方法已經不可使用');
    }
    
}