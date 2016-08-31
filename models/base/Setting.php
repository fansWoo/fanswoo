<?php

class Setting extends ObjDbBase
{
    public $db_name_arr = ['setting'];
    public $db_uniqueid = 'settingid';//填寫物件聯繫資料庫之唯一ID
    public $db_objlist_key = 'keyword';//填寫物件聯繫資料庫之唯一ID
    public $db_field_arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'settingid' => 'settingid',
        'keyword' => 'keyword',
        'value' => 'value',
        'modelname' => 'modelname',
        'locale' => 'locale',
        'status' => 'status'
    );
	
	public function construct($arg = [])
	{
        //set
        $this->set('settingid', $arg['settingid']);
        $this->set('keyword', $arg['keyword']);
        $this->set('value', $arg['value']);
        $this->set('modelname', $arg['modelname']);
        $this->set__status(['status' => $arg['status']]);
        $this->set__locale(['locale' => $arg['locale']]);
        $this->set__uid(['uid' => $uid]);

        return TRUE;
    }
    
    public function construct_db($arg = [])
    {
        if( empty($arg['db_where_arr']['locale']) )
        {
            $this->load->library('i18n');
            $arg['db_where_arr']['locale'] = $this->i18n->get_current_locale();
        }
        parent::construct_db($arg);
    }
	
    //將物件資料更新至資料庫
    public function update($arg = [])
    {
        
        $db_field_arr = $this->get_db_field();
        
        $this->db->from('setting');
        $this->db->where(array(
            'keyword' => $db_field_arr['keyword'],
            'locale' => $db_field_arr['locale']
        ));
        $query = $this->db->get();
        $setting_arr = $query->row_array();

        if( !empty( $setting_arr['settingid'] ) )
        {
            $this->db->where(array(
                'settingid' => $setting_arr['settingid']
            ));
            $db_field_arr['settingid'] = $setting_arr['settingid'];
            $this->db->update($this->db_name_arr[0], $db_field_arr);
        }
        else
        {
            $db_field_arr[$this->db_uniqueid] = db_search_max(array(
                'table_name' => $this->db_name_arr[0],
                'id_name' => $this->db_uniqueid
            )) + 1;
            $this->db->insert($this->db_name_arr[0], $db_field_arr);
        }
    }

}