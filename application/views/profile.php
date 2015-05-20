<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
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
		<li role="presentation" class="active"><a href="<?php echo base_url()."main/profile" ?>">Profile</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/report" ?>">Report</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/logout" ?>">Logout</a></li>
	</ul>
	<p><br/></p>
	<div class="row">		
		<div class="col-xs-6 col-md-3">			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Photo</h3>
				</div>
				<div class="panel-body">
					<div><img src="<?php echo base_url(); ?>/resources/images/<?php echo $user->image_path; ?>" alt="<?php echo base_url(); ?>/resources/images/defult.jpg" class="img-thumbnail"></div>
					<?php echo form_open('main/update_profile_photo',array("enctype"=>"multipart/form-data","accept-charset"=>"utf-8","id"=>"formUpdateProfilePhoto","data-toggle"=>"validator","role"=>"form")); ?>
					<input type="email" value="<?php echo $user->email; ?>" name="email" hidden >
					<div class="form-group">
						<input type="file" id="image_path" name="image_path" required>
					</div>
					<button type="submit" class="btn btn-primary">Update Photo</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-8">			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Profile</h3>
				</div>
				<div class="panel-body">
					<div id="messageUpdateProfile"></div>
					<form id="formUpdateProfile" data-toggle="validator" role="form">
					<div class="form-group">
						<label for="fullname" class="control-label">Full Name</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" data-minlength="3" value="<?php echo $user->full_name; ?>" name="fullname" id="fullname" placeholder="Full Name" required>
						</div>
						<span class="help-block">Minimum of 3 characters</span>
					</div>
					<div class="form-group">
						<label for="placeofbirth">Place of Birth</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" data-minlength="5" value="<?php echo $user->place_of_birth; ?>" name="placeofbirth" id="placeofbirth" placeholder="Place of Birth" required>
						</div>
						<span class="help-block">Minimum of 5 characters</span>
					</div>
					<div class="form-group">
						<label for="dateofbirth">Date of Birth</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" value="<?php echo $user->date_of_birth; ?>" name="dateofbirth" id="dateofbirth" data-error="Date of Birth is required"  placeholder="Date of Birth" required>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="email">Roles</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" value="<?php echo $user->roles; ?>" readonly required>
						</div>
					</div>
					<div class="form-group">
						<label for="email">Email address</label>							
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">@</span>
							<input type="email" class="form-control" value="<?php echo $user->email; ?>" name="email" id="email" placeholder="Email" readonly required>
						</div>
					</div>					
					<button type="form" class="btn btn-primary">Update Profile</button>
					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Password</h3>
				</div>
				<div class="panel-body">
					<div id="messageUpdateProfilePassword"></div>
					<form id="formUpdateProfilePassword" data-toggle="validator" role="form">
					<div class="form-group">
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
					<button type="submit" class="btn btn-primary">Update Password</button>
					</form>
				</div>
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
			$("#dateofbirth").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
		});
		$( "#formUpdateProfile" ).submit(function( event ) {
			var fullname = $("#fullname").val();
			var email = $('#email').val();
			var placeofbirth = $("#placeofbirth").val();
			var dateofbirth = $('#dateofbirth').val();
			
			if(fullname.length >2 && placeofbirth != "" && dateofbirth != ""){
				//alert(email);
				datap = "email="+email+"&full_name="+fullname+"&place_of_birth="+placeofbirth+"&date_of_birth="+dateofbirth;
				$.ajax({
					type: 'POST',
					data: datap,
					url: "<?php echo base_url()."main/update_profile" ?>"
				}).done(function(data){
					$("#messageUpdateProfile").html( data );
				});
			}
			return false;
		});
		
		$( "#formUpdateProfilePassword" ).submit(function( event ) {
			var email = $('#email').val();
			var password = $("#password").val();
			var cpassword = $('#cpassword').val();
			if(password == cpassword && password.length > 5 ){
				//alert(email);
				datap = "email="+email+"&password="+password;
				$.ajax({
					type: 'POST',
					data: datap,
					url: "<?php echo base_url()."main/update_profile_password" ?>"
				}).done(function(data){
					$("#messageUpdateProfilePassword").html( data );
				});
			}
			return false;
		});
	</script>
  </body>
</html>