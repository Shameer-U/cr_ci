<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint_model extends CI_Model {


    public function register($data)
	{
	   $this->db->insert('complaints', $data);
	   $insert_id = $this->db->insert_id();
	   $this->initialise_pending_status($insert_id, $data['date']);
	}

	public function load_all_complaints($status)
	{
		if ($status != 'all')
		{
		  $this->db->where('status', $status);
	    }

		$this->db->order_by('complaint_no', 'DESC');
		$query = $this->db->get('complaints');

		if ($query->num_rows() > 0)
		{
            return $query->result_array();
		}
		else
		{
			return false;
		}
	}


	//Load a specific customer
	public function show_complaint_details($complaint_no){

		$this->db->where('complaint_no', $complaint_no);
		$query = $this->db->get('complaints');

		if ($query->num_rows() > 0){
            return $query->row_array();
		}else{
			return false;
		}
		
	}

	public function get_img_name($complaint_no){
		$this->db->where('complaint_no', $complaint_no);
		$result = $this->db->get('complaints')->row()->img_name;
		return $result;
	}

	public function update_complaint_details($complaint_no, $customer_name, $mobile_no, $date, $address, $item_name,$image_name, $complaint,$barcode){
		
		$data = array(
			'customer_name' => $customer_name,
			'mobile_no' => $mobile_no,
			'date' => $date,
			'address' => $address,
			'item_name' => $item_name,
			'img_name'  => $image_name,
			'complaint' => $complaint,
			'barcode' => $barcode
		);

		$this->db->where('complaint_no', $complaint_no);
		return $this->db->update('complaints',$data);
	}

	public function change_status($complaint_no, $status){

		$data = array('status' => $status);    
		$this->db->where('complaint_no', $complaint_no);
		return $this->db->update('complaints', $data); 

	}

	public function permanently_delete_complaint($complaint_no){
		$this->db->where('complaint_no', $complaint_no);
		return $this->db->delete('complaints');
	}

	/*Status_track section */

	public function initialise_pending_status($complaint_no, $pending_date){
		 $data = array('complaint_no' => $complaint_no,
					   'pending' => $pending_date); 
		return $this->db->insert('status_track', $data);
	}

	public function update_status_track($complaint_no, $status, $date){
		$data = array(
				   $status => $date   
			   );

		 $this->db->where('complaint_no', $complaint_no);
		 return $this->db->update('status_track', $data); 
	   
	}

	public function get_time_line($complaint_no){
		$this->db->where('complaint_no', $complaint_no);
		$query = $this->db->get('status_track');

		if ($query->num_rows() > 0){
            return $query->row_array();
		}else{
			return false;
		}
	}
	


}
