<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Area</title>
    <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>resources/css/jquery-ui.min.css" rel="stylesheet">
  </head>
  <body>
<div id="container">
	<p><br/></p>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-5">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="page-header" style="margin-top:5px;">
						<h3>Registration Area</h3>
					</div>
					<?php echo form_open('main/signup_validation',array("data-toggle"=>"validator","role"=>"form")); ?>
					<?php echo validation_errors(); ?>
					<div class="form-group">
						<label for="fullname" class="control-label">Full Name</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" data-minlength="3" name="fullname" id="fullname" placeholder="Full Name" required>
						</div>
						<span class="help-block">Minimum of 3 characters</span>
					</div>
					<div class="form-group">
						<label for="placeofbirth">Place of Birth</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" data-minlength="5" name="placeofbirth" id="placeofbirth" placeholder="Place of Birth" required>
						</div>
						<span class="help-block">Minimum of 5 characters</span>
					</div>
					<div class="form-group">
						<label for="dateofbirth">Date of Birth</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" name="dateofbirth" id="dateofbirth" data-error="Date of Birth is required"  placeholder="Date of Birth" required>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="email">Email address</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">@</span>
							<input type="email" class="form-control" name="email" id="email" data-error="Email address is invalid" placeholder="Email" required>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-star"></span></span>
							<input type="password" data-minlength="6" class="form-control" name="password" id="password" placeholder="Password" required>
						</div>
						<span class="help-block">Minimum of 6 characters</span>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-star"></span></span>
							<input type="password" class="form-control" name="cpassword" id="cpassword" data-match="#password" data-match-error="These don't match" placeholder="Confirm Password" required>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<button type="submit" class="btn btn-primary">Sign Up</button> or 
					<a class="btn btn-success" href="<?php echo base_url()."main/frontpage"; ?>" role="button">Back to Front Page</a>
					<p><br/></p>
				<?php echo form_close(); ?>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
	<script src="<?php echo base_url(); ?>resources/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url(); ?>resources/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>resources/js/validator.min.js"></script>
	<script>
		$(function(){
			$("#dateofbirth").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
		});
	</script>
  </body>
</html>
</html>