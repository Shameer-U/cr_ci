<div class="container">


       <div class="login-container" id="login-box">

		   <div id="email_submit">
                <div id="info" class="my-3">
                    Please provide the email provided at the registration.
                    An OTP will be send to your email.
                </div>
                <form method="POST" action="">
                <div class="form-group">
                    <label id="label_id">Email</label>
                    <input type="hidden" id="hidden_email">
                    <input type="email" id="email_otp_verify" name="verify_email" class="form-control" placeholder="Enter email" autocomplete="off">
                </div>
                  <button type="submit" id="email_submit_button" name="submit_email" class="btn btn-primary btn-block">Submit Email</button>
                 <button type="submit" id="otp_submit_button" name="submit_otp" class="btn btn-primary btn-block">Submit OTP</button>
                </form>
           </div>


       </div>
</div>


<script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/popper_js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap-4.2.1/js/bootstrap.min.js"></script>
<script>

//making OTP submit button unclickable
$('#otp_submit_button').attr('type', '');
$('#otp_submit_button').hide();


//Email submission
    $('#email_submit_button').click(function(e){

        e.preventDefault();
        e.stopPropagation();

        var email  = $('#email_otp_verify').val();
                $.ajax({
                    method:'POST',
                    url:'<?php echo base_url();?>forgotpswd_controller/verify_email',
                    data:{verify_email:email},
                    dataType:'JSON',
                    beforeSend: function() {
                        $('#email_submit_button').html('loading.....');
                    },
                    success: function(data){
                        //to change the effect of beforesend
                        $('#email_submit_button').html('Submit Email'); 
                        
                        if(data.status == false){
                            $('#info').html('wrong email, Please Enter correct Email');
                         }
                        else if(data.status == true && data.email_status == 'success'){

                            $('#info').html('An OTP has been sent to your email.<br>Please enter OTP to proceed.<br>do not refresh this page');
                            $('#label_id').html('OTP')
                            $('#email_otp_verify').val('');
                            $('#email_otp_verify').attr('placeholder', 'Enter OTP');

                           //OTP button clickable
                            $('#otp_submit_button').show();
                            $('#otp_submit_button').attr('type', 'submit');
                            //email button unclickable
                            $('#email_submit_button').hide();
                            $('#email_submit_button').attr('type', '');

                             $('#hidden_email').attr('value', data.email_value);

                        }
                        else if(data.status == true && data.email_status == 'failed'){
                            $('#info').html('Could not send OTP to email, Please try again');
                        }
                    },
                    error:function(){
                        //to change the effect of beforesend
                        $('#email_submit_button').html('Submit Email'); 

                        alert('could not get data from database');
                    }

                });
                     
    });


    //OTP submission
    $('#otp_submit_button').click(function(e){
        e.preventDefault();
        e.stopPropagation();

        var otp_typed  = $('#email_otp_verify').val();
        var hidden_email  = $('#hidden_email').val();

            $.ajax({
                method:'POST',
                url:'<?php echo base_url();?>forgotpswd_controller/verify_otp',
                data:{otp:otp_typed, email:hidden_email},
                dataType:'JSON',
                beforeSend: function() {
                    $('#otp_submit_button').html('loading.....');
                },
                success: function(data){
                     //to change the effect of beforesend
                     $('#otp_submit_button').html('Submit OTP');

                    if(data.status == true){
                        window.location = '<?php echo base_url();?>forgotpswd_controller/show_resetpassword_page/'+data.admin_id;
                        
                    }else{
                        $('#info').html('wrong OTP, Please Enter correct OTP');
                    }
                },
                error:function(){
                     //to change the effect of beforesend
                    $('#otp_submit_button').html('Submit OTP');
                    
                    alert('could not get data from database');
                }
    
            });
  
       });


</script>


</body>
</html>
