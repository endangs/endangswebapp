<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
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
						<h3>Forgot Password</h3>
					</div>
					<?php echo form_open('main/email_validation',array("data-toggle"=>"validator","role"=>"form")); ?>
						<div style="color:maroon;"><?php echo validation_errors(); ?></div>
						<div class="form-group">
							<label for="email">Enter Your Email address</label>							
							<div class="input-group">
								<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
								<input type="email" class="form-control" name="email" data-error="Email address is invalid" id="email" placeholder="Enter email" required>
							</div>
							<div class="help-block with-errors"></div>
						</div>
						<button class="btn btn-primary">Send Email</button> or 
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
  </body>
</html>
</html>