<?php
		
class Product_Controller extends MY_Controller {
	
	public function delete_stock()
	{
        $data = $this->data;

        $stockid = $this->input->get('stockid');

        if( empty($data['User']->uid) )
        {
            echo '操作權限不足';
            return FALSE;
        }
		
		if( !empty($stockid) )
        {
            $StockProductShop = new StockProductShop();
            $StockProductShop->construct(['stockid' => $stockid]);
            $StockProductShop->delete();
            return TRUE;
		}
        else
        {
            echo '處理失敗';
            return FALSE;
        }
	}
    
}

?>