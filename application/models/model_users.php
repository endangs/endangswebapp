<?php

class Model_users extends CI_Model{
	
    public function can_log_in(){
		$this->db->where('email',$this->input->post('email'));
		$this->db->where('password',md5($this->input->post('password')));
		$query = $this->db->get('users');
		
		if($query->num_rows() == 1){
			return true;
		} else {
			return false;
		}
	}
	
	public function does_email_exist(){
		$this->db->where('email',$this->input->post('email'));
		$query = $this->db->get('users');
		
		if($query->num_rows() == 1){
			return true;
		} else {
			return false;
		}
	}
	
	public function add_temp_users($key){
		$data = array(
			'email' => $this->input->post('email'),
			'password' => md5($this->input->post('password')),
			'full_name' => $this->input->post('fullname'),
			'date_of_birth' => $this->input->post('dateofbirth'),
			'place_of_birth' => $this->input->post('placeofbirth'),
			'[key]' => $key
		);
		$query = $this->db->insert('temp_users', $data);
		
		if($query){
			return true;
		} else {
			return false;
		}
	}
	
	public function is_key_valid($key){
		$this->db->where('[key]',$key);
		$query = $this->db->get('temp_users');
		
		if($query->num_rows() == 1){
			return true;
		} else {
			return false;
		}
	}
	
	public function is_encrypt_valid($encrypt){
		$this->db->where('enrypted_email',$encrypt);
		$query = $this->db->get('view_encrypted_email');
		
		if($query->num_rows() == 1){
			return $query->row()->email;
		} else {
			return false;
		}
	}
	
	public function add_user($key){
		$this->db->where('[key]',$key);
		$temp_user = $this->db->get('temp_users');
			
		if($temp_user){
			$row = $temp_user->row();
			$data = array(
			    'email' => $row->email,
				'full_name' => $row->full_name,
				'date_of_birth' => $row->date_of_birth,
				'place_of_birth' => $row->place_of_birth,
			    'password' => $row->password,
				'image_path'=>'default.jpg',
				'roles'=>'EDITOR'
		    );
			$did_add_user = $this->db->insert('users', $data);
		}
		
		if($did_add_user){
			$this->db->where('[key]',$key);
		    $this->db->delete('temp_users');
			return $data["email"];
		} else return false;
	}
	
	public function user_audit_log($what,$who,$when){
		$data = array(
			'what' => $what,
			'who' => $who,
			'[when]' => $when
		);
		$this->db->insert('user_audit_logs', $data);
	}
	
	public function get_user_audit_log(){
		return $this->db->get('audit_log')->result();
	}
	
	public function get_active_users(){
		return $this->db->order_by("log_count","DESC")->get('view_active_users')->result();
	}
	
	public function get_registered_users($start_date,$end_date){
		$this->db->order_by("date","ASC");
		$this->db->where('date >=',$start_date);
		$this->db->where('date <=',$end_date);
		return $this->db->get('view_registered_users')->result();
	}
	
	public function get_user_role($email){
		return $this->db->where("email",$email)->get('users')->row()->roles;
	}
	
	public function get_user_name($email){
		return $this->db->where("email",$email)->get('users')->row()->full_name;
	}
	
	public function get_detail_user($email){
		return $this->db->where("email",$email)->get('users')->row();
	}
	
	public function update_user_password(){
		$data = array(
			'password' => md5($this->input->post('password'))
		);
		$email = $this->input->post('email');
		$query = $this->db->where('email',$email)->update('users', $data);
		
		if($query){
			return true;
		} else {
			return false;
		}
	}
}
?>