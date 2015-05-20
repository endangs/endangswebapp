<?php

class Model_articles extends CI_Model{
	
    public function get_data_admin_articles(){
		$this->load->model('model_users');
		$email = $this->session->userdata('email');
		$roles = $this->model_users->get_user_role($email);
		
		if($roles == "ADMIN"){
			$this->db->order_by("id","DESC");
			$this->db->select("a.id,a.title,a.created_by,a.created_at,c.category,c.id as category_id,a.content");
			$this->db->from("articles a");
			$this->db->join("categories c","a.category = c.id");
			return $this->db->get()->result();
		} else {
			$this->db->order_by("id","DESC");
			$this->db->where("created_by",$email);
			$this->db->select("a.id,a.title,a.created_by,a.created_at,c.category,c.id as category_id,a.content");
			$this->db->from("articles a");
			$this->db->join("categories c","a.category = c.id");
			return $this->db->get()->result();
		}
	}
	
	public function get_data_articles($begin,$end){
		$str = "SELECT * FROM view_paging_articles WHERE no_row BETWEEN $begin AND $end";
		return $this->db->query($str)->result();
	}
	
	public function get_sum_articles(){
		return $this->db->get("articles")->num_rows();
	}
}
?>