<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {


    public function checkusername_and_password($login_username, $login_password){
      
        $data = array('username'=> $login_username,
                      'password' => $login_password
                     );
        $result = $this->db->get_where('admins', $data);

        if($result->num_rows() == 1 ){
            return true;
        }
        else{
            return false;
        }  
    }

    public function get_users_id($login_username, $login_password){
        $data = array(
			'username' => $login_username,
			'password' => $login_password
		);
		$result = $this->db->get_where('admins',$data);

		if($result->num_rows() == 1)
		{
			return $result->row(0)->id;
		}
		else{
			return false;
		}
	}

}