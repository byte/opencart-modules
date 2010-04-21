<?php
class ControllerModuleMyModule extends Controller {
	private $error = array();
	private $_name = 'mymodule';
	private $_version = '1.3'; 
	
	public function index() {   
		$this->load->language('module/' . $this->_name);

		$this->document->title = $this->language->get('heading_title');
		
		$this->load->model('setting/setting');

		$this->data['mymodule_version'] = $this->_version;
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting($this->_name, $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect((HTTPS_SERVER . 'index.php?route=
((HTTPS_SERVER . 'index.php?route=extension/module'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_left'] = $this->language->get('text_left');
		$this->data['text_right'] = $this->language->get('text_right');
		
		$this->data['entry_code'] = $this->language->get('entry_code');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['entry_yes'] = $this->language->get( 'entry_yes' ); 
		$this->data['entry_no']	= $this->language->get( 'entry_no' );

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['entry_header'] = $this->language->get( 'entry_header' ); 
		$this->data['entry_title'] = $this->language->get( 'entry_title' );

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		$this->load->model('localisation/language');
		
		$languages = $this->model_localisation_language->getLanguages();
		
		foreach ($languages as $language) {
			if (isset($this->error['code' . $language['language_id']])) {
				$this->data['error_code' . $language['language_id']] = $this->error['code' . $language['language_id']];
			} else {
				$this->data['error_code' . $language['language_id']] = '';
			}
		}
		
  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => (HTTPS_SERVER . 'index.php?route=
(HTTPS_SERVER . 'index.php?route=
((HTTPS_SERVER . 'index.php?route=common/home'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => (HTTPS_SERVER . 'index.php?route=
(HTTPS_SERVER . 'index.php?route=
((HTTPS_SERVER . 'index.php?route=extension/module'),
       		'text'      => $this->language->get('text_module'),
      		'separator' => ' :: '
   		);
		
   		$this->document->breadcrumbs[] = array(
       		'href'      => (HTTPS_SERVER . 'index.php?route=
(HTTPS_SERVER . 'index.php?route=
((HTTPS_SERVER . 'index.php?route=module/mymodule'),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = (HTTPS_SERVER . 'index.php?route=
(HTTPS_SERVER . 'index.php?route=
((HTTPS_SERVER . 'index.php?route=module/' . $this->_name);
		
		$this->data['cancel'] = (HTTPS_SERVER . 'index.php?route=
(HTTPS_SERVER . 'index.php?route=
((HTTPS_SERVER . 'index.php?route=extension/module');

		$this->load->model('localisation/language');
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_code' . $language['language_id']])) {
				$this->data[$this->_name . '_code' . $language['language_id']] = $this->request->post[$this->_name . '_code' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_code' . $language['language_id']] = $this->config->get($this->_name . '_code' . $language['language_id']);
			}
		}
		
		foreach ($languages as $language) {
			if (isset($this->request->post[$this->_name . '_title' . $language['language_id']])) {
				$this->data[$this->_name . '_title' . $language['language_id']] = $this->request->post[$this->_name . '_title' . $language['language_id']];
			} else {
				$this->data[$this->_name . '_title' . $language['language_id']] = $this->config->get($this->_name . '_title' . $language['language_id']);
			}
		}

		$this->data['languages'] = $languages;	

		if (isset($this->request->post[$this->_name . '_code'])) {
			$this->data[$this->_name . 'mymodule_code'] = $this->request->post[$this->_name . '_code'];
		} else {
			$this->data[$this->_name . '_code'] = $this->config->get($this->_name . '_code');
		}	
		
		if (isset($this->request->post[$this->_name . '_position'])) {
			$this->data[$this->_name . '_position'] = $this->request->post[$this->_name . '_position'];
		} else {
			$this->data[$this->_name . '_position'] = $this->config->get($this->_name . '_position');
		}
		
		if (isset($this->request->post[$this->_name . '_status'])) {
			$this->data[$this->_name . '_status'] = $this->request->post[$this->_name . '_status'];
		} else {
			$this->data[$this->_name . '_status'] = $this->config->get($this->_name . '_status');
		}
		
		if (isset($this->request->post[$this->_name . '_sort_order'])) {
			$this->data[$this->_name . '_sort_order'] = $this->request->post[$this->_name . '_sort_order'];
		} else {
			$this->data[$this->_name . '_sort_order'] = $this->config->get($this->_name . '_sort_order');
		}				

		if( isset( $this->request->post[$this->_name . '_header'] ) ) { 
			$this->data[$this->_name . '_header'] = $this->request->post[$this->_name . '_header']; 
		}else{ 
			$this->data[$this->_name . '_header'] = $this->config->get( $this->_name . '_header' ); 
		}

		if( isset( $this->request->post[$this->_name . '_title'] ) ) { 
			$this->data[$this->_name . '_title'] = $this->request->post[$this->_name . '_title']; 
		}else{ 
			$this->data[$this->_name . '_title'] = $this->config->get( $this->_name . '_title' ); 
		} 
		
		$this->template = 'module/' . $this->_name . '.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/' . $this->_name)) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>
