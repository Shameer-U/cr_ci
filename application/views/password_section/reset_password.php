<div class="container">

    <div class="login-container" >
    <div >
        
        <form method="POST" action="<?php echo base_url();?>forgotpswd_controller/change_password" >
            <div class="form-group">
                <label>New Password</label>
                <input type="text" id="new_password_id" name="new_password" class="form-control" placeholder="Enter new password" autocomplete="off" >
                <input type="hidden"  name="passed_id" value="<?php echo $id; ?>">
                <span class="error_form" id="password_errmsg"></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" id="confirm_password_id" name="confirm_password" class="form-control" placeholder="Enter password again" autocomplete=off >
                <span class="error_form" id="confirm_password_errmsg"></span>
            </div>
            <button type="submit" id="resetpassword_button" name="reset_password" class="btn btn-primary btn-block">Save</button>
        </form>
    </div>
    </div>

</div>

<script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/popper_js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap-4.2.1/js/bootstrap.min.js"></script>
<!--
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
<script>


    $('#confirm_password_errmsg').hide();
    $('#password_errmsg').hide();

    var error_msg;
    var error_span_id;
    var error_input_field;

    var error_confirm_password = true;
    var error_password = true;

    $('#new_password_id').on('input',function(){
        check_password(); 
    });
    $('#confirm_password_id').on('input',function(){
        check_confirmpassword(); 
    });

    function check_password(){
        var new_password     =  $('#new_password_id').val();
        var new_password_length     =  $('#new_password_id').val().length;
        var pattern          =  new RegExp("^[a-zA-Z0-9]*$");
        var pattern_char     =  new RegExp("^[a-zA-Z]*$");
        var pattern_letter   =  new RegExp("^([0-9]+)$");
        
                if(!pattern.test(new_password))
                {
                    display_error_msg('Only alphanumerics are allowed', '#password_errmsg', '#new_password_id');
                    error_password = true; 
                }
                else if(new_password_length < 8)
                {
                    display_error_msg('Minimum 8 characters are required', '#password_errmsg', '#new_password_id');
                    error_password = true;    
                }
                else if(new_password_length > 20)
                {
                    display_error_msg('Maximum 20 characters are allowed', '#password_errmsg', '#new_password_id');
                    error_password = true; 
                }
                else if(pattern.test(new_password) && new_password_length >= 8 && new_password_length < 20)
                {    
                    hide_error('#password_errmsg', '#new_password_id' );
                    error_password = false;
                }
               
    }

   
    function check_confirmpassword(){
        var new_password     =  $('#new_password_id').val();
        var confirm_password = $('#confirm_password_id').val();
       
        if(confirm_password == new_password)
        {
            hide_error('#confirm_password_errmsg', '#confirm_password_id' );
            error_confirm_password = false;
        }else
        {
            display_error_msg('Passwords do not match', '#confirm_password_errmsg', '#confirm_password_id');
            error_confirm_password = true;
        }
    }


       $('#resetpassword_button').submit(function(e){
            check_confirmpassword();
            check_password();
            
            if(error_confirm_password == true  || error_password == true )
            {
                    e.preventDefault();
                    e.stopPropagation();
            }
        });


    function hide_error(error_span_id, error_input_field){
        $(error_span_id).hide();
        $(error_input_field).css("border", "1px solid #ced4da");
    }

    function display_error_msg(error_msg, error_span_id, error_input_field){
        $(error_span_id).html(error_msg);
        $(error_span_id).show();
        $(error_span_id).css("color", "#F90A0A");
        $(error_input_field).css("border", "2px solid #F90A0A");
    }
</script>

</body>
</html>
