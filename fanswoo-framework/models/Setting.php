<?php

class Setting extends ObjDbBase
{
    public $settingid_Num = 0;
    public $keyword_Str = '';
    public $value_Str = '';
    public $modelname_Str = '';
    public $locale_Str = '';
    public $status_Num = 1;
    public $db_name_Str = 'setting';//填寫物件聯繫資料庫之名稱
    public $db_name_Arr = ['setting'];
    public $db_uniqueid_Str = 'settingid';//填寫物件聯繫資料庫之唯一ID
    public $db_uniquefield_Arr = ['keyword', 'locale'];//填寫物件聯繫資料庫之唯一ID
    public $db_field_Arr = array(//填寫資料庫欄位與本物件屬性之關係，前者為資料庫欄位，後者為屬性
        'settingid' => 'settingid_Num',
        'keyword' => 'keyword_Str',
        'value' => 'value_Str',
        'modelname' => 'modelname_Str',
        'locale' => 'locale_Str',
        'status' => 'status_Num'
    );
	
	public function construct($arg)
	{
        //set
        $this->set('settingid_Num', $arg['settingid_Num']);
        $this->set('keyword_Str', $arg['keyword_Str']);
        $this->set('value_Str', $arg['value_Str']);
        $this->set('modelname_Str', $arg['modelname_Str']);
        $this->set__locale_Str(['locale_Str' => $arg['locale_Str']]);
        $this->set__uid_Num(['uid_Num' => $uid_Num]);

        return TRUE;
    }
    
    public function construct_db($arg)
    {
        if( empty($arg['db_where_Arr']['locale']) )
        {
            $this->load->library('i18n');
            $arg['db_where_Arr']['locale'] = $this->i18n->get_current_locale();
        }
        parent::construct_db($arg);
    }
	
    //將物件資料更新至資料庫
    public function update($arg = [])
    {
        $db_name_Str = $this->db_name_Str;
        
        $db_field_Arr = $this->get_db_field();
        
        $this->db->from('setting');
        $this->db->where(array(
            'keyword' => $db_field_Arr['keyword'],
            'locale' => $db_field_Arr['locale']
        ));
        $query = $this->db->get();
        $setting_Arr = $query->row_array();

        if( !empty( $setting_Arr['settingid'] ) )
        {
            $this->db->where(array(
                'settingid' => $setting_Arr['settingid']
            ));
            $db_field_Arr['settingid'] = $setting_Arr['settingid'];
            $this->db->update($db_name_Str, $db_field_Arr);
        }
        else
        {
            $db_field_Arr[$this->db_uniqueid_Str] = db_search_max(array(
                'table_name' => $this->db_name_Arr[0],
                'id_name' => $this->db_uniqueid_Str
            )) + 1;
            $this->db->insert($db_name_Str, $db_field_Arr);
        }
    }

}