<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
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
						<h3>Reset Passsword</h3>
					</div>
					<?php echo form_open('main/update_password',array("data-toggle"=>"validator","role"=>"form")); ?>
					<?php echo validation_errors(); ?>
					<div class="form-group">
						<label for="email">Email Address</label>							
						<input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" readonly required>
					</div>
					<div class="form-group">
						<label for="password">New Password</label>
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
					<button type="submit" class="btn btn-primary">OK</button>
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