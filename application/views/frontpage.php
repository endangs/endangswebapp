<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Endangs</title>
    <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
<div class="container">
    <div class="page-header">
		<h1>Endang Saepudin <small>website</small></h1>
	</div>
	<p><br/></p>
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<?php
			foreach($articles as $result){
			?>
				<h2><?php echo $result->title; ?></h2>
				<div><?php echo $result->content; ?></div>
				<small><span class="glyphicon glyphicon-bookmark"> Category: <?php echo $result->category; ?></span></small>
			<?php
			}
			echo "<p><br/></p>Page : ".$paging;
			?>			
		</div>
		<div class="col-xs-6 col-md-4">
			<?php echo form_open('main/login_validation',array("data-toggle"=>"validator","role"=>"form")); ?>
				<div style="color:maroon;"><?php echo validation_errors(); ?></div>
				<div class="form-group">
					<label for="email">Email address</label>							
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span>
						<input type="email" class="form-control" name="email" data-error="Email address is invalid" id="email" placeholder="Enter email" required>
					</div>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<div class="input-group">
						<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-star"></span></span>
						<input type="password" class="form-control" data-error="Password is required" name="password" id="password" placeholder="Password" required>
					</div>
					<div class="help-block with-errors"></div>
				</div>
					<button type="submit" class="btn btn-primary">Sign In</button> or 
					<a class="btn btn-success" href="<?php echo base_url()."main/signup"; ?>" role="button">Sign Up</a>	or
					<a class="btn btn-danger" href="<?php echo base_url()."main/forgot_password"; ?>" role="button">Forgot Password</a>
				<p><br/></p>
			<?php echo form_close(); ?>
		</div>
	</div>
	<footer>
		<br/>
		<p>
		&copy;Endang Saepudin 2015
		</p>
	</footer>
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="test" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="mySmallModalLabel">Small modal</h4>
				</div>
				<div class="modal-body">
					Hai... salam kenal dari <strong>dul</strong>. Jika dialog ini muncul dan Anda bisa baca tulisan ini berarti Bootstrap berhasil di load dan terintegrasi dengan baik. Selamat Belajar
				</div>
			</div>
		</div>
	</div>
</div>
    <script src="<?php echo base_url(); ?>resources/js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>resources/js/validator.min.js"></script>
  </body>
</html>