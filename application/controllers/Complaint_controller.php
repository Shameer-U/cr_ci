<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint_controller extends CI_Controller {
    /* 
       NOTES:
         always check a functions working  when you are writing code 
       -> enter 'http://[::1]/MY_OWN/Complaintsystem/complaint_controller/load_complaint_section' (i.e, base_url/controller/function)
         in the search space .this will excecute the function 'load_complaint_section'
       -> then use print_r(), echo , die() functions in 'load_complaint_section' to check the working of code.
       ->this way you can view the results directly in a web page.
       ->to check a function in the 'model' you have to load that function in a controller , like
          $this->complaint_model->load_all_complaints();. 
        -> then use print_r(), echo , die() functions in 'load_all_complaints' to check the working of code.

    */

    public function __construct(){
        parent::__construct();
        $this->check_logged_in();
    }
     
    public function  check_logged_in(){
        if (! $this->session->userdata('logged_in')) { 
            redirect('login_controller');
        } 
    }

    public function load_complaint_section($status ='all')
	{ 
        $status = str_replace('_', ' ',$status);
        $data['complaints'] = $this->complaint_model->load_all_complaints($status);
        $data['current_status'] = $status;
        $this->load->view('templates/header');
        $this->load->view('dashboard/complaint_section',$data);
    }

    

    public function register_new_complaint(){
        
            $customer_name = $this->input->post('customer_name');
            $mobile_no = $this->input->post('mobile_no');
            $date = $this->input->post('date');
            $address = $this->input->post('address');
            $item_name = $this->input->post('item_name');
            $complaint = $this->input->post('complaint');
            $barcode = $this->input->post('barcode');

            
                //Upload Image
                $config['upload_path'] = APPPATH.'../assets/upload_images' ;
                $config['allowed_types'] = 'gif|jpeg|jpg|png' ;
                $config['max_size'] = '1024' ;
                $config['max_width'] = '2000' ;
                $config['max_height'] = '1600' ;
                //my custom name for file
                $config['file_name'] = $item_name . date('YmdHms').'_'.rand(1,999999);

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile')) {

                        /*errors during upload */
                        $errors =  $this->upload->display_errors();
                        $result = $errors;

                } 
                else {

                       // $data =array('upload_data' => $this->upload->data());
                       // $disp_image = $_FILES['userfile']['name'];
                       // echo $disp_image;die();

                        $uploaded = $this->upload->data();
                        $image_name = $uploaded['file_name'];
                        

                        $data = array(
                            'customer_name' => $customer_name,
                            'mobile_no' => $mobile_no,
                            'date' => $date,
                            'address' => $address,
                            'item_name' => $item_name,
                            'img_name'  => $image_name,
                            'complaint' => $complaint,
                            'barcode' => $barcode,
                            'status'  => 'pending'
                        );    
            
                       $this->complaint_model->register($data);
                       $result = 'success';

                    }
                
           echo json_encode($result);
    }

  


    public function show_all_complaints(){
    
     $status = $this->input->post('status');
     $result = $this->complaint_model->load_all_complaints($status);
   //  echo json_encode($result);
     $data['allcomplaints'] = $result;
     $this->load->view('templates/header');
     $this->load->view('complaint_section', $data);

    }

    public function load_complaint_details($complaint_no)
	{ 
        $data['error'] ='';
        $data['details'] = $this->complaint_model->show_complaint_details($complaint_no);
		$this->load->view('templates/header');
		$this->load->view('dashboard/view_complaint_details', $data);
    }

    public function update_complaint_details($complaint_no){
            $data['error'] =''; 
            
            $customer_name = $this->input->post('customer_name');
            $mobile_no = $this->input->post('mobile_no');
            $date = $this->input->post('date');
            $address = $this->input->post('address');
            $item_name = $this->input->post('item_name');
            $complaint = $this->input->post('complaint');
            $barcode = $this->input->post('barcode');

             //Upload Image
             $config['upload_path'] = APPPATH.'../assets/upload_images' ;
             $config['allowed_types'] = 'gif|jpeg|jpg|png' ;
             $config['max_size'] = '1024' ;
             $config['max_width'] = '2000' ;
             $config['max_height'] = '1600' ;
             $config['file_name'] = $item_name . date('YmdHms').'_'.rand(1,999999);

             $this->load->library('upload', $config);

             if ( ! $this->upload->do_upload('myfile')) {

                     /*errors during upload */
                 $data['error'] =  $this->upload->display_errors();
                 $this->session->set_flashdata('update_complaint_details','updation failed');

             } 
             else {

                // $data =array('upload_data' => $this->upload->data());
                 //$disp_image = $_FILES['myfile']['name'];

                 $uploaded = $this->upload->data();
                 $image_name = $uploaded['file_name'];
                 //echo $disp_image;die();
                
                 
                 /*remove image from folder */
                 $img_name_to_delete = $this->complaint_model->get_img_name($complaint_no);
                 $image_path = APPPATH.'../assets/upload_images/' ;
                 $filename = $image_path . $img_name_to_delete;
                 if(file_exists($filename)){
                       unlink($filename);  
                 }

                 $this->complaint_model->update_complaint_details($complaint_no,$customer_name,$mobile_no,$date,$address,$item_name,$image_name, $complaint,$barcode);
                 $this->session->set_flashdata('update_complaint_details', 'customer details have been successfully updated');

                 }

           
            
            $data['details'] = $this->complaint_model->show_complaint_details($complaint_no);
            $this->load->view('templates/header');
            $this->load->view('dashboard/view_complaint_details', $data);
    
    }

    public function showAllCompletedComplaints(){

        $this->load->view('templates/header');
        $this->load->view('dashboard/completed_items');
    }

    public function delete_complaint($complaint_no){
        //we have to get name of image before removing it from database
        $img_name_to_delete = $this->complaint_model->get_img_name($complaint_no);

        $this->complaint_model->permanently_delete_complaint($complaint_no);

         /*remove image from folder */
         $image_path = APPPATH.'../assets/upload_images/' ;
         $filename = $image_path . $img_name_to_delete;
         if(file_exists($filename)){
               unlink($filename);  
         }

        $this->session->set_flashdata('deleted_complaint', 'customer details have been successfully deleted');
        redirect('complaint_controller/load_complaint_section');
    }

    public function change_status(){

        $status = $this->input->post('status');
        $complaint_no = $this->input->post('complaint_no');
        $this->complaint_model->change_status($complaint_no,$status); 

        if($status == 'waiting for approval'){
            $status = 'waiting_for_approval';
        }
        $date = date('d-m-Y');
        //updating status_track at the same time
        $this->complaint_model->update_status_track($complaint_no, $status, $date);
        echo json_encode('chumma');
    }

    public function show_time_line(){
        $complaint_no = $this->input->post('complaint_no');
        $result = $this->complaint_model->get_time_line($complaint_no);
        echo json_encode($result);
    }

    

}
