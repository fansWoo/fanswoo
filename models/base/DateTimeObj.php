<?php

class DateTimeObj extends ObjBase {

    public $datetime = '';//ex:1988-02-26 19:31:00
    public $unix = 0;//ex:1234567890
    public $getdate_arr = '';//ex:['year','month','date','hour','minute','second']
    public $inputtime_date = '';//ex:1988-02-26
    public $inputtime_time = '';//ex:19:31:00
	
	public function construct($arg = [])
	{
        $datetime = !empty($arg['datetime']) ? $arg['datetime'] : '';//ex:1988-02-26 19:31:00
        $unix = !empty($arg['unix']) ? $arg['unix'] : 0;//ex:1234567890
        $inputtime_date = !empty($arg['inputtime_date']) ? $arg['inputtime_date'] : '';//ex:1988-02-26
        $inputtime_time = !empty($arg['inputtime_time']) ? $arg['inputtime_time'] : '';//ex:19:31:00
        
        if(!empty($inputtime_date) && !empty($inputtime_time))
        {
            $datetime = $inputtime_date.' '.$inputtime_time;
            $unix = strtotime($datetime);
            $getdate_arr = getdate($unix);
        }
        else if(!empty($datetime) && $datetime !== '0000-00-00 00:00:00')
        {
            $inputtime_arr = explode(' ', $datetime);
            $inputtime_date = $inputtime_arr[0];
            $inputtime_time = $inputtime_arr[1];
            $unix = strtotime($datetime);
            $getdate_arr = getdate($unix);
        }
        else if(!empty($unix))
        {
            $getdate_arr = getdate($unix);
            $datetime = date('Y-m-d H:i:s', $unix);
            $inputtime_arr = explode(' ', $datetime);
            $inputtime_date = $inputtime_arr[0];
            $inputtime_time = $inputtime_arr[1];
        }
        else
        {
            $FS_model = new FS_model();
            $timenow = $FS_model->config->item('timenow');
            
            $unix = $timenow;
            $datetime = date('Y-m-d H:i:s', $unix);
            $inputtime_arr = explode(' ', $datetime);
            $inputtime_date = $inputtime_arr[0];
            $inputtime_time = $inputtime_arr[1];
            $getdate_arr = getdate($unix);
        }
        
        //set
        $this->unix = $unix;
        $this->getdate_arr = $getdate_arr;
        $this->datetime = $datetime;
        $this->inputtime_date = $inputtime_date;
        $this->inputtime_time = $inputtime_time;
        
        return TRUE;
    }
	
}