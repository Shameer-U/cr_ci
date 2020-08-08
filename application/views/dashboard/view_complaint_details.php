<div class="container">
    <?php if($this->session->flashdata('update_complaint_details')): ?>
        <p class="alert alert-success my-3 flash_message"><?php echo $this->session->flashdata('update_complaint_details'); ?></p>
    <?php endif; ?>
    <div class="my-3" style="background-color:red; color:#fff;">
       <?php echo validation_errors(); ?>
    </div>
    <!--file upload errors-->
    <div style="background-color:red; color:#fff;">
            <?php  echo  $error ; ?>
    </div>
</div>

        <div class="container">
        <div class="status-adjust">
            <button type="button" class="btn btn-danger to-delete-button" id="delete_button" data-toggle="modal" data-target="#deleteModal">Delete Permanently</button>
           
            <div class="status-section" >
                   <div class="status-label">Status :</div>
                    <div class="status-change-button-container">
                        <select class="form-control" id="status_change_button">       
                        </select>
                    </div>
            </div>
            </div>   
        
        </div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       Are you sure you want  to permanently delete this item ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="<?php echo base_url();?>complaint_controller/delete_complaint/<?php echo $details['complaint_no']?>">Delete</a>
      </div>
    </div>
  </div>
</div>


    <div class="container mb-3 ">
    <div class="row">


    <div class="col-md-4">
        <div class="card" style="width:100%;">
            <div class="card-header">
                Time line
            </div>
            <ul class="list-group list-group-flush" id="timeline_ul">
                <li class="list-group-item">pending :<span id="pending_id"></span></li>
                <li class="list-group-item">waiting for approvel :<span id="waiting_approval_id"></span> </li>
                <li class="list-group-item">approved :<span id="approved_id"></span> </li>
                <li class="list-group-item">rejected :<span id="rejected_id"></span> </li>
                <li class="list-group-item">completed :<span id="completed_id"></span> </li>
            </ul>
        </div>
    </div>

    <div class="col-md-8">
            <div class="px-3" style="border:1px solid rgba(0, 0, 0, 0.125); background-color:rgba(0,0,0,.03);">

            <div><h2 class="py-3 text-center">Complaint Details</h2></div>

                <form class="py-3 px-3" method="POST" action="<?php echo base_url();?>complaint_controller/update_complaint_details/<?php echo $details['complaint_no']; ?>"  enctype="multipart/form-data" >

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Complaint No </label>
                    <div class="col-md-2">
                        <input type="text" readonly class="form-control-plaintext" name="complaint_no" id="complaint_no" disabled="disabled"  value="<?php echo $details['complaint_no']; ?>" >
                        <input type="hidden" id="current_status_id" value="<?php echo $details['status']; ?>">
                    </div>   
                </div> 
                <div class="form-group">
                    <label>Customer Name</label>
                    <input class="form-control" type="text" id="name_field" name="customer_name" value="<?php echo $details['customer_name']; ?>" autocomplete="off" >
                    <span class="error_form" id="name_errmsg"></span>
                </div> 

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Mobile No</label>
                    <div class="col-md-4">
                        <input type="text" name="mobile_no" id="mobileno_field" class="form-control" value="<?php echo $details['mobile_no']; ?>" autocomplete="off">
                        <span class="error_form" id="mobileno_errmsg"></span>
                    </div>

                    <label class="offset-md-1 col-md-2 col-form-label">Date</label>
                    <div class="col-md-3">
                        <input type="text" name="date" id="date_field" class="form-control" value="<?php echo $details['date']; ?>" autocomplete="off" >
                        <span class="error_form" id="date_errmsg"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea type="textarea" name="address" id="address_field" class="form-control" placeholder="Enter Address" autocomplete="off"><?php echo $details['address']; ?></textarea>
                    <span class="error_form" id="address_errmsg"></span>
                </div> 
                <div class="form-group">
                    <label>Item Name</label>
                    <input type="text" name="item_name" id="itemname_field" class="form-control" value="<?php echo $details['item_name']; ?>" autocomplete="off">
                    <span class="error_form" id="itemname_errmsg"></span>
                </div> 
                <div class="form-group">
                        <label>Choose Image</label>
                        <input type="file" class="form-control" name="myfile" id="img_field" size="20" >
                        <span class="error_form" id="img_errmsg"></span>
                </div> 
                <div class="form-group">
                    <label>Complaint</label>
                    <textarea type="textarea"  name="complaint" id="complaint_field" class="form-control" placeholder="Enter Complaint" autocomplete="off"><?php echo $details['complaint']; ?></textarea>
                    <span class="error_form" id="complaint_errmsg"></span>
                </div> 
                
                <div class="form-group">
                    <label>Barcode (If Available)</label>
                    <input type="text" name="barcode" class="form-control" value="<?php echo $details['barcode']; ?>" autocomplete="off">
                </div>  
                <button type="submit" name="submit" id="update_complaint_button" class="btn btn-success d-block mx-auto todisable" style="width:300px;">Save Changes</button>
                </form>

           </div>
        </div>    
</div>
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

<script>
    $(document).ready(function(){
        
    var current_status = $('#current_status_id').val();  
    show_time_line();
    show_current_status(current_status);
    hide_or_show_delete_button();


    $('#status_change_button').on('change', function() {
        var current_value = $(this).val().toLowerCase();
        var complaint_no = $('#complaint_no').val();
 
        $.ajax({
            method:'POST',
            url:'<?php echo base_url();?>complaint_controller/change_status',
            data:{status:current_value, complaint_no:complaint_no},
            dataType:'JSON',
            success: function(){ 
                show_current_status(current_value);//takes status value from here itself
                show_time_line();
            },
            error:function(){
                alert('could not get data from database');
            }
        });
      hide_or_show_delete_button();

    });

    var status_pass;
    function show_current_status(status_pass){
        var html ='<option>'+status_pass+'</option>';
        var status =['pending','waiting for approval','approved','rejected','completed'];
        $.each(status, function(index, value) {
            if (value != status_pass){
                html += '<option>'+value+'</option>';
            }
          });
          $('#status_change_button').html(html);  

    }

    function show_time_line(){
        var complaint_no = $('#complaint_no').val();
        $.ajax({
            method:'POST',
            url:'<?php echo base_url();?>complaint_controller/show_time_line',
            data:{complaint_no:complaint_no},
            dataType:'JSON',
            success: function(details){ 
                $('#pending_id').text(details.pending);
                $('#waiting_approval_id').text(details.waiting_for_approval);
                $('#approved_id').text(details.approved);
                $('#rejected_id').html(details.rejected);//just showing that 'html' also can be used.
                $('#completed_id').html(details.completed);
            },
            error:function(){
                alert('could not get data from database');
            }

        });
    }
    

    function hide_or_show_delete_button(){
        var status_value = $('#status_change_button').val();
        if(status_value == 'completed' || status_value == 'rejected'){
            $("#delete_button").show(); 
            $("#delete_button").removeAttr("disabled");  
            $(".status-adjust").css("width", "500");
        }
        else{
            $("#delete_button").hide(); 
            $("#delete_button").attr("disabled", "disabled"); 
            $(".status-adjust").css("width", "300");
        }
    }


});
</script>

</body>
</html>

