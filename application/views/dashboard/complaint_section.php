<div class="container">
 <h1 class="my-3 text-center">Welcome to complaint section</h1>

 <div class="container">
    <?php if($this->session->flashdata('deleted_complaint')): ?>
        <p class="alert alert-success my-3 flash_message"><?php echo $this->session->flashdata('deleted_complaint'); ?></p>
    <?php endif; ?>
    <div class="my-3" style="background-color:red; color:#fff;">
       <?php echo validation_errors(); ?>
    </div>
</div>



        <!-- Button trigger modal -->
	<div class="row">
		<div class="col-md-10">
			<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#create_complaint_modal">
				Create New Complaint
			</button>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<select class="form-control" id="status_change_button">
                    <?php $status_value = str_replace('', '_',$current_status); ?>
					<option value="<?php echo $status_value; ?>"><?php echo $current_status; ?></option>
                    <?php 
                      $all_status =['all','pending','waiting for approval', 'approved','rejected', 'completed']; 
                      foreach($all_status as $status):
                         if($status != $current_status ):
                         $status_value = str_replace(' ', '_',$status);
                    ?>
					  <option value="<?php echo $status_value; ?>"><?php echo $status; ?></option>
                    <?php 
                       endif;
                       endforeach; 
                    ?>
				</select>
			</div>
		</div>
    </div>
    
    
                     

<!-- Modal -->
<div class="modal fade" id="create_complaint_modal" tabindex="-1" role="dialog" aria-labelledby="complaintModalLabel" aria-hidden="true">
  <!--increased width with .modal-lg -->
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="complaintModalLabel">New Complaint</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form class="px-4 py-3" id="create_complaint_form" method="POST" action="<?php echo base_url();?>complaint_controller/register_new_complaint" enctype="multipart/form-data" >
  
               <div class="modal-body">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" id="name_field" class="form-control" placeholder="Enter Customer Name" autocomplete="off">
                        <span class="error_form" id="name_errmsg"></span>
                    </div>  

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Mobile No</label>
                        <div class="col-md-4">
                           <input type="text" name="mobile_no" id="mobileno_field" class="form-control" placeholder="Enter Phone" autocomplete="off"/>
                           <span class="error_form" id="mobileno_errmsg"></span>
                        </div>
                        
                        <label class="offset-md-1 col-md-2 col-form-label">Date</label>
                        <div class="col-md-3">
                            <input type="text" name="date" id="date_field" class="form-control" autocomplete="off">
                            <span class="error_form" id="date_errmsg"></span>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea type="textarea" name="address" id="address_field" class="form-control" placeholder="Enter Address" autocomplete="off"></textarea>
                        <span class="error_form" id="address_errmsg"></span>
                    </div> 
                    <div class="form-group">
                        <label>Item Name</label>
                        <input type="text" name="item_name" id="itemname_field" class="form-control" placeholder="Enter Item Name" autocomplete="off">
                        <span class="error_form" id="itemname_errmsg"></span>
                    </div> 
                    <div class="form-group">
                        <label>Choose Image</label>
                        <input type="file" class="form-control" name="userfile" id="img_field" size="20">
                        <span class="error_form" id="img_errmsg"></span>
                    </div> 
                    <div class="form-group">
                        <label>Complaint</label>
                        <textarea type="textarea" name="complaint" id="complaint_field" class="form-control" placeholder="Enter Complaint" autocomplete="off"></textarea>
                        <span class="error_form" id="complaint_errmsg"></span>
                    </div> 
                    
                    <div class="form-group">
                        <label>Barcode (If Available)</label>
                        <input type="text" name="barcode" id="barcode_field" class="form-control" placeholder="Enter Barcode" autocomplete="off">
                        <span class="error_form" id="barcode_errmsg"></span>
                    </div>  
                 </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="create_complaint_button" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
    </div>
        

    <table id="dataTable" class="display mt-2" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Img</th>
                <th>Mobile No</th>
                <th>Date</th>
                <th>Address</th>
                <th>Status</th>
				<th>action</th>>
            </tr>
        </thead>
        <tbody>

        <?php if(!empty($complaints)):
                 foreach( $complaints as $complaint): ?>
          <tr>
             <td><?php echo $complaint['complaint_no']; ?></td>
             <td><?php echo $complaint['customer_name']; ?></td>
             <td><img style="width:50px; height:50px;" src="<?php echo base_url() ?>assets/upload_images/<?php echo $complaint['img_name']; ?>" alt=""></td>
             <td><?php echo $complaint['mobile_no']; ?></td>
             <td><?php echo $complaint['date']; ?></td>
             <td><?php echo $complaint['address']; ?></td>
             <td><?php echo $complaint['status']; ?></td>
			  <td><a class="btn btn-info btn-sm" href="<?php echo base_url();?>complaint_controller/load_complaint_details/<?php echo $complaint['complaint_no']; ?>">view</a></td>
             
          </tr>
       <?php endforeach;
            endif;
         ?>
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Img</th>
                <th>Mobile No</th>
                <th>Extn.</th>
                <th>Date</th>
                <th>Address</th>
				<th>action</th>
            </tr>
        </tfoot>
    </table>

  
</div>

<script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/popper_js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap-4.2.1/js/bootstrap.min.js"></script>
<!-- daterangepicker jquery file -->
<script src="<?php echo base_url() ?>assets/vendor/daterangepicker-master/moment.min.js"></script>
<script src="<?php echo base_url() ?>assets/vendor/daterangepicker-master/daterangepicker.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url();?>assets/js/complaint_validation.js"></script> 

<script>
    var timeout = 3000;
    $('.flash_message').delay(timeout).fadeOut(300);
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/vendor/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable( {  } );
 });
</script>

<script>

     $('#status_change_button').on('change', function() {
        var status_value = $(this).val();
        window.location = '<?php echo base_url();?>complaint_controller/load_complaint_section/'+status_value;

    });
</script>


</body>
</html>

