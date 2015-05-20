<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Members Page</title>
    <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>resources/css/jquery-ui.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>resources/css/bootstrap3-wysihtml5.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>resources/css/bootstrap3-wysihtml5-editor.css" rel="stylesheet">
  </head>
  <body>
<div class="container">
    <div class="page-header">
		<h1>Endang Saepudin <small>Members Page</small></h1>
	</div>
	<ul class="nav nav-pills">
		<li role="presentation"><a href="<?php echo base_url()."main/members" ?>">Home</a></li>
		<li role="presentation" class="active"><a href="<?php echo base_url()."main/article" ?>">Article</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/profile" ?>">Profile</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/report" ?>">Report</a></li>
		<li role="presentation"><a href="<?php echo base_url()."main/logout" ?>">Logout</a></li>
	</ul>
	<p><br/></p>
	<div class="row">
		<div class="col-xs-12 col-md-10">
			<h2>List of Articles</h2>
			<button type="button" class="btn btn-primary btn-lg"  onclick="addData();">
				Add
			</button>
			<br/><br/>
			<div id="viewdata"></div>

			<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">Add Article</h4>
						</div>
						<div class="modal-body">
							<input type="text" id="id" value="0" hidden>
							<div class="form-group">								
								<label for="title">Title</label>								
								<input type="text" class="form-control" id="title" name="title" id="title" placeholder="Enter title" required>
							</div>
							<div class="form-group">
								<label for="category">Category</label>
								<div class="radio">
									<label>
										<input type="radio" value="1" name="category" id="1" required>
										Business
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="2" name="category" id="2" required>
										Technology
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="3" name="category" id="3" required>
										Politics
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" value="4" name="category" id="4" required>
										Life Styles
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="content">Content</label>
								<textarea class="textarea" id="content" style="width:100%;" height="300px"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary" id="save">Save changes</button>
						</div>
					</div>
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
	<script src="<?php echo base_url(); ?>resources/js/wysihtml5x-toolbar.min.js"></script>
	<script src="<?php echo base_url(); ?>resources/js/bootstrap3-wysihtml5.min.js"></script>
	<script>
		$("#content").wysihtml5();
		$.ajax({
			type: 'GET',
			url: "<?php echo base_url()."article/view_article" ?>"
		}).done(function(data){
			$("#viewdata").html( data );
		});
		$("#save").click(function(){
			var id = $("#id").val();
			var title = $("#title").val();
			var content = $("#content").val();
			var category = $( "input:checked" ).val();
			var datap = "";
			if(id == 0){
				datap = "title="+title+"&content="+content+"&category="+category;
				$.ajax({
					type: 'POST',
					data: datap,
					url: "<?php echo base_url()."article/insert_article" ?>"
				}).done(function(data){
					$("#viewdata").html( data );
					$('#myModal').modal('hide');
				});
			} else {
				datap = "id="+id+"&title="+title+"&content="+content+"&category="+category;
				$.ajax({
					type: 'POST',
					data: datap,
					url: "<?php echo base_url()."article/update_article" ?>"
				}).done(function(data){
					$("#viewdata").html( data );
					$('#myModal').modal('hide');
				});
			}
		});
		function addData(){
			$('#myModal').modal('show');
			$('#myModalLabel').html("Add Artcile");
			$("#id").val(0);
			$('#title').val("");
			$('#content').data("wysihtml5").editor.setValue('');
			$("#1").prop("checked", false);
			$("#2").prop("checked", false);
			$("#3").prop("checked", false);
			$("#4").prop("checked", false);
		}
		function editData(id,title,category_id,content){
			$('#myModal').modal('show');			
			$('#myModalLabel').html("Edit Artcile");
			$("#id").val(id);
			$('#title').val(title);
			$('#content').data("wysihtml5").editor.setValue(content);
			$("#"+category_id+"").prop("checked", true);
		}
		function deleteData(id) {
			if (confirm("Are you sure?")) {
				datap = "id="+id;
				$.ajax({
					type: 'POST',
					data: datap,
					url: "<?php echo base_url()."article/delete_article" ?>"
				}).done(function(data){
					$("#viewdata").html( data );
					$('#myModal').modal('hide');
				});
			}
			return false;
		}
	</script>
  </body>
</html>