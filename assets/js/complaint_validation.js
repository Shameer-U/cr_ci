$(document).ready(function(){

    
	/* date range picker */
	$(function () {
		$('input[name="date"]').daterangepicker({
			singleDatePicker: true,
            showDropdowns: true,
            locale: { format: 'DD/MM/YYYY'} ,
			minYear: 1901
		}, function (start, end, label) {
		});
	});

//disable operations at date field
    $('#date_field').keydown(function(){
        return false;
    });
    $('#date_field').bind('contextmenu',function(e){
         e.preventDefault();
    });


    var error_msg;
    var error_span_id;
    var error_input_field;

    var error_customername;
    var error_mobilenumber;
    var error_address;
    //var error_date ;
    var error_itemname;
    var error_complaint;
    var error_img;

    $('#name_errmsg').hide();
    $('#mobileno_errmsg').hide();
    $('#date_errmsg').hide();
    $('#address_errmsg').hide();
    $('#itemname_errmsg').hide();
    $('#complaint_errmsg').hide();
    $('#img_errmsg').hide();


    $('#name_field').on('input',function(){
        check_customername(); 
    });
    $('#mobileno_field').on('input',function(){
        check_mobileno();
    });
   /* $('#date_field').on('input',function(){
        check_date();
    });*/
    $('#address_field').on('input',function(){
        check_address(); 
    });
    $('#itemname_field').on('input',function(){
        check_itemname(); 
    });
    $('#complaint_field').on('input',function(){
        check_complaint(); 
    });
    $('#img_field').on('input',function(){
        check_img();
    });
    
    function check_customername(){
        var cust_name = $('#name_field').val();
      
        if(cust_name != '' ){
            hide_error('#name_errmsg', '#name_field');
            error_customername = false;
        }
        else{
            display_error_msg('Invalid name', '#name_errmsg', '#name_field');
            error_customername = true; 
        }

    }

     function check_mobileno(){
            var mobile_no = $('#mobileno_field').val();
            var mobile_no_length = $('#mobileno_field').val().length;
            var pattern = new RegExp("^([0-9]+)$");
    
            if(pattern.test(mobile_no) && mobile_no_length == 10){
                hide_error('#mobileno_errmsg', '#mobileno_field');
                error_mobilenumber = false;
            }
            else if(!pattern.test(mobile_no)){
                display_error_msg('Invalid mobile no', '#mobileno_errmsg', '#mobileno_field');
                error_mobilenumber = true;
            }
            else if(mobile_no_length < 10){
                display_error_msg('10 digits required', '#mobileno_errmsg', '#mobileno_field');
                error_mobilenumber = true;
            }
            else if(mobile_no_length > 10){
               display_error_msg('Typed More than 10 digits', '#mobileno_errmsg', '#mobileno_field');
               error_mobilenumber = true;
            }
    
        }


       /* function check_date(){
            var date_length = $('#date_field').val().length;
    
          if(date_length < 10 ){
                error_msg = 'Invalid date';
                error_span_id = '#date_errmsg';
                error_input_field = '#date_field';
                display_error_msg(error_msg, error_span_id, error_input_field);
                error_date = true;
               
            }
            else{
                $('#date_errmsg').hide();
                $('#date_field').css("border", "1px solid #ced4da");
                error_date = false;
            
            }
    
        }*/

       


        function check_address(){
            var address = $('#address_field').val();
            var address_length = $('#address_field').val().length;
      
            if(address != '' && address_length < 255 ){
                hide_error('#address_errmsg', '#address_field');
                error_address = false;
            }
            else if(address_length >= 255){
                display_error_msg('Too much characters', '#address_errmsg', '#address_field');
                error_address = true;  
            }
            else{
                display_error_msg('Invalid address', '#address_errmsg', '#address_field');
                error_address = true;
            }
    
         }
        
        
        function check_itemname(){
                var itemname = $('#itemname_field').val();
          
                if(itemname !='' ){
                    hide_error('#itemname_errmsg', '#itemname_field');
                    error_itemname = false;  
                }
                else {
                    display_error_msg('Invalid Item name', '#itemname_errmsg', '#itemname_field');
                    error_itemname = true; 
                }
        
            }

            function check_complaint(){
                var complaint = $('#complaint_field').val();
          
                if(complaint != ''){
                    hide_error('#complaint_errmsg', '#complaint_field');
                    error_complaint = false;   
                }
                else{
                    display_error_msg('Invalid complaint', '#complaint_errmsg', '#complaint_field');
                    error_complaint = true; 
                }
        
            }


            function check_img(){
                /* var img_name = $('#img_field').val();
                 var extension = $('#img_field').val().split('.').pop().toLowerCase();  */
          
                 var img_field_value  = $('#img_field').val();
                 if(img_field_value != ''){

                        // var img  = $('#img_field')[0].files[0];
                        // console.log(img);

                         var img_name  = $('#img_field')[0].files[0].name;
                         var extension = img_name.substr((img_name.lastIndexOf('.') + 1)).toLowerCase();
          
                         if(img_name != '' && extension != ''){  
          
                                 if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){   
                                     display_error_msg('file format not supported', '#img_errmsg' , '#img_field' );
                                     error_img = true;
                                     // $('#img_field').val('');    
                                 }
                                 else{
                                      var imgSize = $('#img_field')[0].files[0].size;
                                      var  sizeInKB = imgSize/1024;
                                 
                                     if(sizeInKB > 1024){
                                         display_error_msg('file size should be less than 1 MB', '#img_errmsg' , '#img_field' );
                                         error_img = true;
                                     }
                                     else{
                                         hide_error('#img_errmsg', '#img_field');
                                         error_img = false; 
                                     }  
                                 }  
          
                         }
                         else if(img_name != '' &&  extension == ''){
                             display_error_msg('please provide extension', '#img_errmsg' , '#img_field' );
                             error_img = true;
                         }
                         else if(img_name == ''){
                             display_error_msg('please select an image', '#img_errmsg' , '#img_field' );
                             error_img = true;
                         }  
                         
                 }
                 else{
                     display_error_msg('please select an image', '#img_errmsg' , '#img_field' );
                     error_img = true;
                 }
             }


        //FOR UPDATING COMPLAINT

        $('#update_complaint_button').click(function(e){
             error_customername = true;
             error_mobilenumber = true;
             error_address      = true;
             error_itemname     = true;
             error_complaint    = true;
             error_img          = true;
            check_customername();
            check_mobileno();
            check_address(); 
            check_itemname(); 
            check_complaint();
            check_img();

            if(error_customername == true || error_mobilenumber == true || error_address == true || 
                error_itemname == true || error_complaint == true || error_img == true ){
                    e.preventDefault();
                    e.stopPropagation();
                }
        });
        
   

    //FOR CREATING COMPLAINT

    $('#create_complaint_button').click(function(e){
        
        error_customername = true;
        error_mobilenumber = true;
        error_address      = true;
        error_itemname     = true;
        error_complaint    = true;
        error_img          = true;
        check_customername();
        check_mobileno();
        check_address(); 
        check_itemname(); 
        check_complaint();
        check_img();

        if(error_customername == true || error_mobilenumber == true || error_address == true || 
            error_itemname == true || error_complaint == true || error_img == true){
                e.preventDefault();
                e.stopPropagation();    
            }
        else{

            e.preventDefault();
            e.stopPropagation();

            var cust_name = $('#name_field').val();
            var mobile_no = $('#mobileno_field').val();
            var date = $('#date_field').val();
            var address = $('#address_field').val();
            var itemname = $('#itemname_field').val();
            var complaint = $('#complaint_field').val();
            var barcode = $('#barcode_field').val();


           // var fd = new FormData("#create_complaint_form");
            
            var fd = new FormData();
            var img  = $('#img_field')[0].files[0];
            fd.append('userfile', img);
            fd.append('customer_name', cust_name);
            fd.append('mobile_no', mobile_no);
            fd.append('date', date);
            fd.append('address', address);
            fd.append('item_name', itemname);
            fd.append('complaint', complaint);
            fd.append('barcode', barcode);

            
            $.ajax({
                method:'POST',
                url:'http://[::1]/MY_OWN/Complaintsystem/complaint_controller/register_new_complaint',
                data: fd,
                contentType: false,
                cache: false,
                processData:false,
                dataType:'JSON',
                beforeSend: function() {
                    $('#create_complaint_button').html('loading.....');
                },
                success: function(data){
                    $('#create_complaint_button').html('save');
                    alert(data);

                    if(data == 'success'){
                        //to redirect to complaint section
                        window.location = 'http://[::1]/MY_OWN/Complaintsystem/complaint_controller/load_complaint_section';
                    }
                    
                },
                error:function(){
                    $('#create_complaint_button').html('save');
                    alert('could not get data from database');
                }
    
            });  
        }
    });





    $('#create_complaint_modal').on('hidden.bs.modal', function(){
        $('#create_complaint_form')[0].reset();

        hide_error('#name_errmsg', '#name_field');
        hide_error('#mobileno_errmsg', '#mobileno_field');
        hide_error('#address_errmsg', '#address_field');
        hide_error('#itemname_errmsg', '#itemname_field');
        hide_error('#complaint_errmsg', '#complaint_field');

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
});