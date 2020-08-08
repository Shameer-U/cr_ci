<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpswd_controller extends CI_Controller {

    public function show_forgot_pswd_page(){

        $this->load->view('templates/header');
        $this->load->view('password_section/forgot_password');
    }

    //verify and send otp to email
    public function verify_email(){
        
       $email =  $this->input->post('verify_email');
       $result['status'] = $this->forgotpswd_model->verify_email($email);
       

       if($result['status']){ //email exists in database
           $otp = mt_rand(1000,100000);
           //Load email library
            $this->load->library('email');

            //SMTP & mail configuration
            //Note: Google will automatically turn "Less secure app access" OFF if it’s not being used.
            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'shahulshameer94@gmail.com',
                'smtp_pass' => 'shameer123sha',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );
            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");

            //Email content
            $htmlContent = 'OTP : <h1>'.$otp.'</h1>';
            $htmlContent .= '<p>This is your OTP for resetting password. </p>';
            $htmlContent .= '<p>OTP has been sent to email :'.$email.'</p>';

            $this->email->to('shameerushahul@gmail.com');
            $this->email->from('sender@example.com','OTP-ComplaintSystem');
            $this->email->subject('OTP');
            $this->email->message($htmlContent);

            //Send email
           if(! $this->email->send()){
               //$debug_msg = $this->email->print_debugger();
               $result['email_status']= 'failed';
            }else{
                $result['email_status']= 'success';
                $this->forgotpswd_model->insert_otp($email,$otp);
                $result['email_value'] = $email;
            }
   
        }
           echo json_encode($result);
         
    }

  //verify otp entered with otp in database
   public function verify_otp(){
         $otp_typed =  $this->input->post('otp');
         $email_typed =  $this->input->post('email');
         $result['status'] = $this->forgotpswd_model->verify_otp($email_typed, $otp_typed);
         if($result['status']){
            $result['admin_id'] = $this->forgotpswd_model->get_admin_id($email_typed);
         }
        
         echo json_encode($result);
    }

    //show reset_password.php page
    public function show_resetpassword_page($admin_id){
        $data['id'] = $admin_id;
        $this->load->view('templates/header');
        $this->load->view('password_section/reset_password',$data);
    }

    public function change_password(){
        $new_password = $this->input->post('new_password');
        $id = $this->input->post('passed_id');
        $this->forgotpswd_model->update_password($id, $new_password);
        redirect('login_controller');
    
    }


}
