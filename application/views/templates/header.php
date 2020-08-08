<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>cr</title>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/bootstrap-4.2.1/css/bootstrap.min.css" >
	<!-- daterange CSS -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/daterangepicker-master/daterangepicker.css">
	<!-- -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/vendor/DataTables-1.10.18/css/jquery.dataTables.min.css" >
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/crud_style.css" >
	
</head>

<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav ml-auto">

		<?php  if(!$this->session->userdata('logged_in')):?>
			<li class="nav-item active">
				<a class="nav-link" href="<?php echo base_url()?>login_controller">Home <span class="sr-only">(current)</span></a>
			</li>
		<?php  endif; ?>
		<?php  if($this->session->userdata('logged_in')):?>
		   <li class="nav-item">
				<a class="nav-link" href="<?php echo base_url()?>complaint_controller/load_complaint_section"> Complaints</a>
           </li>
		 <!--  <li class="nav-item">
				<a class="nav-link" href="<?php/* echo base_url()*/?>complaint_controller/showallcompletedcomplaints"> Completed complaints</a>
		   </li>-->
		   <li class="nav-item">
				<a class="btn btn-info" style="color:white;" href="<?php echo base_url()?>login_controller/logout"> Logout</a>
		   </li>
		<?php  endif; ?>
		</ul>
	</div>
	</nav>