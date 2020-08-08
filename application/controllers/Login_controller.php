<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	
	public function index()
	{   
		$data['error'] = "";
		$this->load->view('templates/header');
		$this->load->view('login_view', $data);
	}

	
	public function logout(){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('username');
  
		redirect('login_controller');
	  }
  
	  public function login()
	  {
        $data['error'] =""; 
  
        $login_username = $this->input->post('login_username');
		 // $user_password = md5($this->input->post('login_password'));
		 $login_password = $this->input->post('login_password');

		$this->form_validation->set_rules('login_username', 'Username', 'required');
		$this->form_validation->set_rules('login_password', 'Password', 'required');

		/* during "login" a 'severside validation' is a must, even if you provided 'jquery validation' in view.
		   In all other cases jquery validation is enough, no need to write server side validaion. 
		*/
		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('templates/header');
			$this->load->view('login_view', $data);
		}
		else
		{
			$result = $this->login_model->get_users_id($login_username, $login_password);
		      if($result)
			  {
				$user_data = array(
					'user_id' => $result,
					'username' => $login_username,
					'logged_in' => true
				);
  
				$this->session->set_userdata($user_data);
  
				/*$this->load->view('templates/header');
				$this->load->view('dashboard/complaint_section');*/
				redirect('complaint_controller/load_complaint_section');
			  }
			  else
			  { 
				$result = $this->login_model->checkusername_and_password($login_username, $login_password);
				if($result == false)
				{
				  $data['error'] = "Invalid Username or Password";
				  $this->load->view('templates/header');
				  $this->load->view('login_view', $data);
				}
				else
				{
					$this->load->view('templates/header');
					$this->load->view('login_view', $data);
				}
			  }
		 }

	  }

		

}
