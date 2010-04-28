<?php
class ControllerPaymentIpay88 extends Controller {
	protected function index() {
		$this->language->load('payment/ipay88');
		
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->data['button_back'] = $this->language->get('button_back');

    	$this->data['action'] = 'https://www.mobile88.com/epayment/entry.asp';
		
		$vendor = $this->config->get('ipay88_vendor');
		$password = $this->config->get('ipay88_password');		
		$support_currency = $this->config->get('entry_currency');
		
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		
		
		// Lets start define iPay88 parameters here
		
		$product_data = array();
	
		foreach ($this->cart->getProducts() as $product) {
      		$option_data = array();

      		foreach ($product['option'] as $option) {
        		$option_data[] = array(
          			'name'   => $option['name'],
          			'value'  => $option['value'],
		  			'prefix' => $option['prefix']
        		);
      		}


      		$product_data[] = array(
        		'product_id' => $product['product_id'],
				'name'       => $product['name'],
        		'model'      => $product['model'],
        		'option'     => $option_data,
				'download'   => $product['download'],
				'quantity'   => $product['quantity'], 
				'price'      => $product['price'],
        		'total'      => $product['total'],
				'tax'        => $this->tax->getRate($product['tax_class_id'])
      		); 
    	}
		
		$data['products'] = $product_data;
		
		$this->data['products'] = array();
		
		foreach ($this->cart->getProducts() as $product) {
      		$option_data = array();

      		foreach ($product['option'] as $option) {
        		$option_data[] = array(
          			'name'  => $option['name'],
          			'value' => $option['value']
        		);
      		} 
 
      		$this->data['products'][] = array(
				'product_id' => $product['product_id'],
        		'name'       => $product['name'],
        		'model'      => $product['model'],
        		'option'     => $option_data,
        		'quantity'   => $product['quantity'],
				'tax'        => $this->tax->getRate($product['tax_class_id']),
        		'price'      => $this->currency->format($product['price']),
        		'total'      => $this->currency->format($product['total']),
				'href'       => (HTTP_SERVER . 'index.php?route=product/product&product_id=' . $product['product_id'])
      		); 
    	} 
		
		
		// Let's Generate Digital Signature  
		
		$ipaySignature ='';
		
        $merId = $this->config->get('ipay88_vendor');
        $ikey = $this->config->get('ipay88_password');		
		$tmpAmount = $this->currency->format($order_info['total'], $order_info['currency'], $order_info['value'], FALSE);
		$ordAmount = number_format($tmpAmount, 2, ".", "");
        
		$ipaySignature ='';
	    $HashAmount = str_replace(".","",str_replace(",","",$ordAmount));	
		$str = sha1($ikey  . $merId . $this->session->data['order_id'] . $HashAmount . $order_info['currency']);
		for ($i=0;$i<strlen($str);$i=$i+2)
		{
        $ipaySignature .= chr(hexdec(substr($str,$i,2)));
		}
     
		$ipaySignature = base64_encode($ipaySignature);
		
		// Signature generating done !
		
		// Assign values for form post
		
		
		$this->data['MerchantCode'] = $this->config->get('ipay88_vendor');
		$this->data['PaymentId'] = '';
		$this->data['RefNo'] = $this->session->data['order_id'];
		$this->data['Amount'] = $this->currency->format($order_info['total'], $order_info['currency'], $order_info['value'], FALSE);
		$this->data['Currency'] = $order_info['currency'];
		$this->data['ProdDesc'] = $product['name'];
		$this->data['UserName'] = $order_info['payment_firstname'] . ' ' . $order_info['payment_lastname'];
		$this->data['UserEmail'] = $order_info['email'];
		$this->data['UserContact'] = $order_info['telephone'];
		$this->data['Remark'] = sprintf($this->language->get('text_description'), date($this->language->get('date_format_short')), $this->session->data['order_id']);
		$this->data['Lang'] = "UTF-8";
		$this->data['Signature'] = $ipaySignature;
		

		$this->data['back'] = (HTTPS_SERVER . 'index.php?route=checkout/payment');
		
		$this->id       = 'payment';
		$this->template = $this->config->get('config_template') . '/payment/ipay88.tpl';
		
		$this->render();		
	}
	
	public function callback() 
	{
		

		$expected_sign = $_POST['Signature'];
	    $merId = $this->config->get('ipay88_vendor');
        $ikey = $this->config->get('ipay88_password');	
	
		$expected_sign = "";
	    $merId = "";
        $ikey = "";	
	
	
		$check_sign = "";
		$ipaySignature = "";
		$str = "";
		$HashAmount = "";
		
		$HashAmount = str_replace(array(',','.'), "", $_POST['Amount']);
		$str = $ikey . $merId . $_POST['PaymentId'].trim(stripslashes($_POST['RefNo'])). $HashAmount . $_POST['Currency'].$_POST['Status'];
	
		$str = sha1($str);
	   
	    for ($i=0;$i<strlen($str);$i=$i+2)
		{
        $ipaySignature .= chr(hexdec(substr($str,$i,2)));
		}
       
		$check_sign = base64_encode($ipaySignature);
		
		
			
	if ($_POST['Status'] == "1") 
		{
	
		$this->load->model('checkout/order');
		
		$this->model_checkout_order->confirm($_POST['RefNo'], $this->config->get('ipay88_order_status_id'), "Payment ok", TRUE);	  

				$this->data['continue'] = (HTTPS_SERVER . 'index.php?route=checkout/success');
					
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ipay88_success.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/payment/ipay88_success.tpl';
				} else {
					$this->template = 'default/template/payment/ipay88_success.tpl';
				}	
		
	  			$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
		
		
		
			 
		}	
		else
		{
		
				$this->data['continue'] = (HTTPS_SERVER . 'index.php?route=checkout/cart');
		
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/ipay88_failure.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/payment/ipay88_failure.tpl';
				} else {
					$this->template = 'default/template/payment/ipay88_failure.tpl';
				}
				
	  			$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));	
			
		
		}
		
		
	
	
	


	
	}
}
?>