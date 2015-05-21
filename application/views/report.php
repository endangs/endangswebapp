<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Members Page</title>
    <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>resources/css/jquery-ui.min.css" rel="stylesheet">
  </head>
  <body>
<div class="container">
    <div class="page-header">
		<h1>Endang Saepudin <small>Members Page</small></h1>
	</div>
	<ul class="nav nav-pills">
		<li role="presentation"><a href="<?php echo base_url()."main/members" ?>">Home</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/article" ?>">Article</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/profile" ?>">Profile</a></li>
		<li role="presentation" class="active"><a href="<?php echo base_url()."main/report" ?>">Report</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/logout" ?>">Logout</a></li>
	</ul>
	<p><br/></p>
	<div class="row">
		<div class="col-xs-12 col-md-10">
			<div class="panel-heading">
				<h2>Registered Users Report</h2>
			</div>
			<div class="panel-body">
				<?php echo form_open('excelreport/registered_users',array("data-toggle"=>"validator","role"=>"form")); ?>
					<div class="form-group">
						<label for="startdate">Start Date</label>							
						<input type="text" class="form-control" name="startdate" id="startdate" data-error="Start Date is required"  placeholder="Start Date" required>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="enddate">End Date</label>							
						<input type="text" class="form-control" name="enddate" id="enddate" data-error="End Date is required"  placeholder="End Date" required>
						<div class="help-block with-errors"></div>
					</div>
					<button type="submit" class="btn btn-primary">Show Report</button>
				</form>
			</div>
			<div class="panel-heading">
				<h2>Active Users Report</h2>
			</div>
			<div class="panel-body">
				<?php echo form_open('excelreport/active_users',array("data-toggle"=>"validator","role"=>"form")); ?>
					<button type="submit" class="btn btn-primary">Show Report</button>
				</form>
			</div>
		</div>
	</div>
	<footer>
		<br/>
		<p>
		&copy;Endang Saepudin 2015
		</p>
	</footer>
</div>
    <script src="<?php echo base_url(); ?>resources/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url(); ?>resources/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>resources/js/validator.min.js"></script>
	<script>
		$(function(){
			$("#startdate").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd",
				onClose: function( selectedDate ) {
					$( "#enddate" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$("#enddate").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd",
				onClose: function( selectedDate ) {
					$( "#startdate" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
		});
	</script>
  </body>
</html>