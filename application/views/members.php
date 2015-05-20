<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Members Page</title>
    <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
<div class="container">
    <div class="page-header">
		<h1>Endang Saepudin <small>Members Page</small></h1>
	</div>
	<ul class="nav nav-pills">
		<li role="presentation" class="active"><a href="<?php echo base_url()."main/members" ?>">Home</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/article" ?>">Article</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/profile" ?>">Profile</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/report" ?>">Report</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/logout" ?>">Logout</a></li>
	</ul>
	<p><br/></p>
	<div class="row">
		<div class="col-xs-12 col-md-10">
			<h2>Welcome to Endangs Website</h2>
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
    <script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>resources/js/validator.min.js"></script>
  </body>
</html>