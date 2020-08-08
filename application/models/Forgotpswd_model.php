<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpswd_model extends CI_Model {

    public function verify_email($email){

        $this->db->where('email', $email);
        $result = $this->db->get('admins');
        
        if($result->num_rows() == 1){
            return true;
        }else{
            return false;
        }

    }

    public function insert_otp($email, $otp){
        $data = array('otp'=> $otp);
        $this->db->where('email', $email);
        return $this->db->update('admins',$data);

    }

    public function verify_otp($email_typed,$otp_typed){
       
        $data = array('email'=> $email_typed,
                       'otp' => $otp_typed);
        $result = $this->db->get_where('admins', $data);
        
        if($result->num_rows() == 1){
            return true;
        }else{
            return false;
        }

    }


    public function get_admin_id($email){
        $data = array('email' => $email);
        $result = $this->db->get_where('admins', $data);
        return $result->row(0)->id;
    }
   
    public function update_password($id, $new_password){
        $data = array('password' => $new_password);
        $this->db->where('id', $id);
        return $this->db->update('admins',$data);
    }
}