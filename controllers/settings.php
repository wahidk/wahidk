<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

//*******************************************************************************************************************
//*************
//*************
//*************																					Settings Controller
//*************
//*************
//*******************************************************************************************************************	

    function __construct() {

        parent::__construct();
		
		//chech if the user is logged in:
		is_logged_in();
		//Check and prevent if employee Loggedin
		if($this->session->userdata('user_type') == 2){ show_404(); exit; }
		
		date_default_timezone_set('Asia/Calcutta');

		//Seeting the related js script to dynamic variable
		//$this->config->set_item('dynamic_action_js_file', 'action_user');

        //load all common models and libraries here;
        $this->load->model('settings/mdl_settings', 'settings');
		//Helper
		$this->load->helper('security');
		
	}

//*******************************************************************************************************************
//*************
//*************
//*************																							General Settings
//*************
//*************
//*******************************************************************************************************************		
	//general
	public function general() {
	
		//Presets:
		//Menu contol:
		$data  = array();
		$data['menu_settings_general'] = "active";
		$settings = new stdClass;
		
		//If form submitted
		if($this->input->post()){
			$update_data = array();
			$postdata = $this->input->post();
			
			$i=0;
			foreach($postdata as $key=>$value){
				$update_data[$i]['key'] = $key;
				$update_data[$i]['value'] = $value;
				$i++;
			}
			
			//Update data using batch
			$result = $this->db->update_batch('settings', $update_data, 'key'); 
			
			if($result === FALSE){
				//Throw error
				$new_session_data = array ('settings_general_updated' => 'no');
				$this->session->set_userdata($new_session_data);
			}else{
				$new_session_data = array ('settings_general_updated' => 'yes');
				$this->session->set_userdata($new_session_data);
			}
			
			redirect(base_url()."settings/general");
			exit();
		}
		
		//If form not submitted
		//Pull general settings data
		$settings_general = $this->settings->get_many_by(array('setting_type' => 'general'));	
		
		if($settings_general != NULL){
			foreach($settings_general as $item){
				$key = $item->key;
				$settings->$key = $item->value;
			}
		}
		
		/*echo "<pre>";
		print_r($settings);
		exit();*/
		
		$data['settings'] 				=	$settings;
		$data['settings_subfile']		=	"settings_general";

		$this->load->view('settings_master', $data);	

	}// End genral();
	
//*******************************************************************************************************************
//*************
//*************
//*************																							Leaves Settings
//*************
//*************
//*******************************************************************************************************************		
	//leaves
	public function leaves() {
	
		//Presets:
		//Menu contol:
		$data  = array();
		$data['menu_settings_leaves'] = "active";
		$settings = new stdClass;
		
		//If form submitted
		if($this->input->post()){
			$update_data = array();
			$postdata = $this->input->post();
			
			$i=0;
			foreach($postdata as $key=>$value){
				$update_data[$i]['key'] = $key;
				$update_data[$i]['value'] = $value;
				$i++;
			}
			
			//Update data using batch
			$result = $this->db->update_batch('settings', $update_data, 'key'); 
			
			if($result === FALSE){
				//Throw error
				$new_session_data = array ('settings_leaves_updated' => 'no');
				$this->session->set_userdata($new_session_data);
			}else{
				$new_session_data = array ('settings_leaves_updated' => 'yes');
				$this->session->set_userdata($new_session_data);
			}
			
			redirect(base_url()."settings/leaves");
			exit();
		}
		
		//If form not submitted
		//Pull leaves settings data
		$settings_leaves = $this->settings->get_many_by(array('setting_type' => 'leaves'));	
		
		if($settings_leaves != NULL){
			foreach($settings_leaves as $item){
				$key = $item->key;
				$settings->$key = $item->value;
			}
		}
		
		/*echo "<pre>";
		print_r($settings);
		exit();*/
		
		$data['settings'] 				=	$settings;
		$data['settings_subfile']		=	"settings_leaves";

		$this->load->view('settings_master', $data);	

	}// End leaves();
	
//*******************************************************************************************************************
//*************
//*************
//*************																							Salary Settings
//*************
//*************
//*******************************************************************************************************************		
	//salary
	public function salary() {
	
		//Presets:
		//Menu contol:
		$data  = array();
		$data['menu_settings_salary'] = "active";
		$settings = new stdClass;
		
		//If form submitted
		if($this->input->post()){
			$update_data = array();
			$postdata = $this->input->post();
			
			$i=0;
			foreach($postdata as $key=>$value){
				$update_data[$i]['key'] = $key;
				$update_data[$i]['value'] = $value;
				$i++;
			}
			
			//Update data using batch
			$result = $this->db->update_batch('settings', $update_data, 'key'); 
			
			if($result === FALSE){
				//Throw error
				$new_session_data = array ('settings_salary_updated' => 'no');
				$this->session->set_userdata($new_session_data);
			}else{
				$new_session_data = array ('settings_salary_updated' => 'yes');
				$this->session->set_userdata($new_session_data);
			}
			
			redirect(base_url()."settings/salary");
			exit();
		}
		
		//If form not submitted
		//Pull salary settings data
		$settings_salary = $this->settings->get_many_by(array('setting_type' => 'salary'));	
		
		if($settings_salary != NULL){
			foreach($settings_salary as $item){
				$key = $item->key;
				$settings->$key = $item->value;
			}
		}
		
		/*echo "<pre>";
		print_r($settings);
		exit();*/
		
		$data['settings'] 				=	$settings;
		$data['settings_subfile']		=	"settings_salary";

		$this->load->view('settings_master', $data);	

	}// End salary();

//*******************************************************************************************************************
//*************
//*************
//*************																				Tax Declaration Settings
//*************
//*************
//*******************************************************************************************************************		
	//tax_declaration
	public function tax_declaration() {
	
		//Presets:
		//Menu contol:
		$data  = array();
		$data['menu_settings_tax_declaration'] = "active";
		$settings = new stdClass;
		
		//If form submitted
		if($this->input->post()){
			$update_data = array();
			$postdata = $this->input->post();
			
			$i=0;
			foreach($postdata as $key=>$value){
				//Handling extra options
				if($key == 'tax_setting_extra_option_values' && is_array($value)){
					$value = @implode(',',$value);
				}//Handling extra options ends
			
				$update_data[$i]['key'] = $key;
				$update_data[$i]['value'] = $value;
				$i++;
			}
		
			//Update data using batch
			$result = $this->db->update_batch('settings', $update_data, 'key'); 
			
			if($result === FALSE){
				//Throw error
				$new_session_data = array ('settings_tax_declaration_updated' => 'no');
				$this->session->set_userdata($new_session_data);
			}else{
				$new_session_data = array ('settings_tax_declaration_updated' => 'yes');
				$this->session->set_userdata($new_session_data);
			}
			
			redirect(base_url()."settings/tax_declaration");
			exit();
		}
		
		//If form not submitted
		//Pull tax_declaration settings data
		$settings_tax_declaration = $this->settings->get_many_by(array('setting_type' => 'tax_declaration'));
		if($settings_tax_declaration != NULL){
			foreach($settings_tax_declaration as $item){
				$key = $item->key;
				$settings->$key = $item->value;
			}
		}
		
		/*echo "<pre>";
		print_r($settings);
		exit();*/
		
		//HANDLING EXTRA OPTIONS
		$extra_options = array();
		$extra_options_keys = array();
		$extra_options_values = array();
		//Pulling tax_declaration_extra_options keys from settings table
		$extra_options_keys_str = $this->settings->getValueByKey('tax_declaration_extra_options');
		if($extra_options_keys_str != ""){
			$extra_options_keys = @explode(',', $extra_options_keys_str);
		}
		//Pulling tax_declaration_extra_options valus limits from settings table
		$extra_options_values_str = $this->settings->getValueByKey('tax_setting_extra_option_values');
		if($extra_options_values_str != ""){
			$extra_options_values = @explode(',', $extra_options_values_str);
		}
		
		if(!empty($extra_options_keys)){
			$i = 0;
			foreach($extra_options_keys as $items){
				$extra_options[trim($items)] = ((isset($extra_options_values[$i])) ? trim($extra_options_values[$i]) : "0.00");
				$i++;
			}
		}
		$data['extra_options']	=	$extra_options;
		//HANDLING EXTRA OPTIONS
		
		$data['settings'] 				=	$settings;
		$data['settings_subfile']		=	"settings_tax_declaration";

		$this->load->view('settings_master', $data);	

	}// End tax_declaration();
	
//*******************************************************************************************************************
//*************
//*************
//*************																							Tax Deductions
//*************
//*************
//*******************************************************************************************************************		
	//tax_deduction
	public function tax_deduction() {
	
		//Presets:
		//Menu contol:
		$data  = array();
		$data['menu_settings_tax_deduction'] = "active";
		$settings = new stdClass;
		
		//If form submitted
		if($this->input->post()){
			$update_data = array();
			$postdata = $this->input->post();
			
			$i=0;
			foreach($postdata as $key=>$value){
				$update_data[$i]['key'] = $key;
				$update_data[$i]['value'] = $value;
				$i++;
			}
			
			//Update data using batch
			$result = $this->db->update_batch('settings', $update_data, 'key'); 
			
			if($result === FALSE){
				//Throw error
				$new_session_data = array ('settings_tax_deduction_updated' => 'no');
				$this->session->set_userdata($new_session_data);
			}else{
				$new_session_data = array ('settings_tax_deduction_updated' => 'yes');
				$this->session->set_userdata($new_session_data);
			}
			
			redirect(base_url()."settings/tax_deduction");
			exit();
		}
		
		//If form not submitted
		//Pull tax_deduction settings data
		$settings_tax_deduction = $this->settings->get_many_by(array('setting_type' => 'tax_deduction'));	
		
		if($settings_tax_deduction != NULL){
			foreach($settings_tax_deduction as $item){
				$key = $item->key;
				$settings->$key = $item->value;
			}
		}
		
		/*echo "<pre>";
		print_r($settings);
		exit();*/
		
		$data['settings'] 				=	$settings;
		$data['settings_subfile']		=	"settings_tax_deduction";

		$this->load->view('settings_master', $data);	

	}// End tax_deduction();


	

}/* End of file settings.php */

/* Location: ./application/modules/settings/controllers/settings.php */