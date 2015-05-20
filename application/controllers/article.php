<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends CI_Controller {

	public function index()
	{
	}
	
	public function view_article(){
		if($this->session->userdata('is_logged_in')){		
			$this->load->model('model_articles');
			$query = $this->model_articles->get_data_admin_articles();
			?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>id</th>
						<th>Title</th>
						<th>Category</th>
						<th>Created By</th>
						<th>Created At</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
			<?php
			foreach($query as $result){
			?>
				<tr>
				<td><?php echo $result->id; ?></td>
				<td><?php echo $result->title; ?></td>
				<td><?php echo $result->category; ?></td>
				<td><?php echo $result->created_by; ?></td>
				<td><?php echo $result->created_at; ?></td>
				<td>
					<a class="btn btn-success btn-sm" onclick="editData(<?php echo $result->id; ?>,'<?php echo $result->title; ?>','<?php echo $result->category_id; ?>','<?php echo $result->content; ?>');">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
					<a class="btn btn-danger btn-sm" onclick="deleteData(<?php echo $result->id; ?>);">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
				</tr>
			<?php
			}
			?>
				</tbody>
			</table>
			<?php
		} else {
			redirect('main/restricted');
		}
	}
	
	public function insert_article(){
		if($this->session->userdata('is_logged_in')){
			$title = $this->input->post("title",true);
			$category = $this->input->post("category",true);
			$content = $this->input->post("content",false);
			$created_by = $this->session->userdata('email');
			$created_at = date("Y-m-d H:i:s",time());
			$data = array("title"=>$title,"category"=>$category,"content"=>$content,"created_by"=>$created_by,"created_at"=>$created_at);
			if($this->db->insert("articles",$data)){
				$this->load->model('model_users');
				$this->model_users->user_audit_log("CREATE ARTICLE",$this->session->userdata('email'),date("Y-m-d H:i:s",time()));
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Data has been saved successfully.
			</div>
			<?php
				$this->view_article();
			} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> Data can not be saved.
			</div>
			<?php
			}
		} else {
			redirect('main/restricted');
		}
	}
	
	public function update_article(){
		if($this->session->userdata('is_logged_in')){
			$id = $this->input->post("id",true);
			$title = $this->input->post("title",true);
			$category = $this->input->post("category",true);
			$content = $this->input->post("content",false);
			$updated_by = $this->session->userdata('email');
			$updated_at = date("Y-m-d H:i:s",time());
			$data = array("title"=>$title,"category"=>$category,"content"=>$content,"updated_by"=>$updated_by,"updated_at"=>$updated_at);
			if($this->db->where("id",$id)->update("articles",$data)){
				$this->load->model('model_users');
				$this->model_users->user_audit_log("UPDATE ARTICLE",$this->session->userdata('email'),date("Y-m-d H:i:s",time()));
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Data has been saved successfully.
			</div>
			<?php
				$this->view_article();
			} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> Data can not be saved.
			</div>
			<?php
			}
		} else {
			redirect('main/restricted');
		}
	}
	
	public function delete_article(){
		if($this->session->userdata('is_logged_in')){
			$id = $this->input->post("id",true);
			if($this->db->where("id",$id)->delete("articles")){
				$this->load->model('model_users');
				$this->model_users->user_audit_log("DELETE ARTICLE",$this->session->userdata('email'),date("Y-m-d H:i:s",time()));
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Data has been deleted successfully.
			</div>
			<?php
				$this->view_article();
			} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error!</strong> Data can not be deleted.
			</div>
			<?php
			}
		} else {
			redirect('main/restricted');
		}
	}	
}