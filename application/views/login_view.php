<div class="container">
base url: <?php echo base_url();?>
       <div class="login-container" id="login-box">
		    
            <div class="text-center">
             <h2>Login</h2>
           </div>
            <div style="background-color:red; color:#fff;">
            <?php echo validation_errors(); ?>
            </div>
            <div class="text-center" style="background-color:red; color:#fff;">
                <?php if(!empty($error)){
                    echo $error;
                }
                ?>
            </div>


           <form method="POST" action="<?php echo base_url();?>login_controller/login">
                <div class="form-group">
                    <label>User name</label>
                    <input type="text" name="login_username" class="form-control" placeholder="Enter name" autocomplete="off">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="login_password" class="form-control"  placeholder="Enter Password">
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
           </form>

        <div>
           <a href="<?php echo base_url();?>forgotpswd_controller/show_forgot_pswd_page">Forgot Password?</a> 
        </div>
       </div>
</div>


<script src="<?php echo base_url();?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/popper_js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap-4.2.1/js/bootstrap.min.js"></script>
</body>
</html>



