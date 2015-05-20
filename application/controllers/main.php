<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index()
	{
		$this->frontpage();
	}
	
	public function frontpage(){
		$this->load->model('model_articles');
		$this->load->library("pagination");		
		$config['base_url'] = site_url('main/frontpage');
		$config['total_rows'] = $this->model_articles->get_sum_articles();
		$config['per_page'] = $per_page = 2;
		$config['first_page'] = 'First';
		$config['last_page'] = 'Last';
		$config['next_page'] = '&laquo;';
		$config['prev_page'] = '&raquo;';
		$config['cur_tag_open'] = ' <strong>';
		$config['cur_tag_close'] = '</strong>';
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);
		$data['paging'] = $this->pagination->create_links();
		$page = ($this->uri->segment(3))?$this->uri->segment(3):0;
		$begin = $page + 1;
		$end = $page + $per_page;
		$data["articles"] = $this->model_articles->get_data_articles($begin,$end);
        $this->load->view('frontpage',$data);
	}
	
	public function signup(){
		$this->load->view('signup');
	}
	
	public function restricted(){
		$this->load->view('restricted');
	}
	
	public function forgot_password(){
		$this->load->view('forgotpassword');
	}
	
	public function article(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('article');
		} else {
			redirect('main/restricted');
		}
	}
	
	public function report(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('report');
		} else {
			redirect('main/restricted');
		}
	}
	
	public function profile(){
		if($this->session->userdata('is_logged_in')){
			$this->load->model('model_users');
			$email = $this->session->userdata('email');
			$data["user"] = $this->model_users->get_detail_user($email);
			$this->load->view('profile',$data);
		} else {
			redirect('main/restricted');
		}
	}
	
	public function members(){
		if($this->session->userdata('is_logged_in')){
			$this->load->view('members');
		} else {
			redirect('main/restricted');
		}		
	}
	
	public function login_validation(){
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean|callback_validate_credentials');
		$this->form_validation->set_rules('password','Password','required|md5');
		
		if($this->form_validation->run()){
			$data = array(
			    'email' => $this->input->post('email'),
				'is_logged_in' => 1
			);
			$this->session->set_userdata($data);
			$this->load->model('model_users');
			$this->model_users->user_audit_log("LOGIN",$this->input->post('email'),date("Y-m-d H:i:s",time()));
			redirect('main/members');
		}else{
			$this->frontpage();
		}
	}
	
	public function validate_credentials(){
		$this->load->model('model_users');
		if($this->model_users->can_log_in()){
			return true;
		} else {
			$this->form_validation->set_message('validate_credentials','Incorrect username/password. ');
			return false;
		}
	}
	
	public function email_validation(){
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean|callback_validate_email');
		
		if($this->form_validation->run()){
			$this->load->model('model_users');
			$email = $this->input->post("email");
			$name = $this->model_users->get_user_name($email);
			$encrypt = md5($email);
			$this->load->library('email',array('mailtype'=>'html'));
			$this->email->from('dunkznawawy@gmail.com',"Endang Saepudin");
			$this->email->to($email);
			$this->email->subject("Forget Password");
			$message = "<p>Hi $name, </p";
			$message .= "<p><a href='".base_url()."main/reset_password/$encrypt' >Click here</a> to reset your password</p>";
			$this->email->message($message);
			if($this->email->send()){
				echo "Your password reset link send to your e-mail address.";
				//echo "<p><a href='".base_url()."main/reset_password/$encrypt' >Click here</a> to reset your password</p>";
			} else {
				echo "Could not send the email!";
			}
		}else{
			$this->load->view('forgotpassword');
		}
	}
	
	public function validate_email(){
		$this->load->model('model_users');
		if($this->model_users->does_email_exist()){
			return true;
		} else {
			$this->form_validation->set_message('validate_email',"Email doesn't exists. ");
			return false;
		}
	}
	
	public function signup_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fullname','Full Name','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[password]');
		$this->form_validation->set_rules('placeofbirth','Place of Birth','required|trim');
		$this->form_validation->set_rules('dateofbirth','Date of Birth','required|trim');
		$this->form_validation->set_message('is_unique','This email address already exists. ');
		if($this->form_validation->run()){
			$key = md5(uniqid());
			$this->load->model('model_users');
			$this->load->library('email',array('mailtype'=>'html'));
			$this->email->from('dunkznawawy@gmail.com',"Endang Saepudin");
			$this->email->to($this->input->post('email'));
			$this->email->subject("Confirm your account.");
			$message = "<p>Thank you for signing up!</p>";
			$message .= "<p><a href='".base_url()."main/register_user/$key' >Click here</a> to confirm your account</p>";
			$this->email->message($message);
			if($this->model_users->add_temp_users($key)){
			    if($this->email->send()){
					$this->model_users->user_audit_log("REGISTRATION",$this->input->post('email'),date("Y-m-d H:i:s",time()));
					echo "Your account activation link has been sent to your e-mail address.";
				    //echo "<p><a href='".base_url()."main/register_user/$key' >Click here</a> to confirm your account</p>";
			    } else {
				    echo "Could not send the email!";
			    }
			}
		}else{
			$this->load->view('signup');
		}
	}
	
	public function logout(){
		$this->load->model('model_users');
		$this->model_users->user_audit_log("LOGOUT",$this->session->userdata('email'),date("Y-m-d H:i:s",time()));
		$this->session->sess_destroy();
		redirect('main/frontpage');
	}
	
	public function register_user($key){
		$this->load->model('model_users');
		if($this->model_users->is_key_valid($key)){
			if($newemail = $this->model_users->add_user($key)){
				$data = array(
			        'email' => $newemail,
				    'is_logged_in' => 1
			    );
			    $this->session->set_userdata($data);
				$this->model_users->user_audit_log("ACTIVATION",$newemail,date("Y-m-d H:i:s",time()));
				$this->model_users->user_audit_log("LOGIN",$newemail,date("Y-m-d H:i:s",time()));
			    redirect('main/members');
			} else echo "Failed to add user, please try again !"; 
		} else {
			echo "Invalid Key";
		}
	}
	
	public function reset_password($encrypt){
		$this->load->model('model_users');
		if($data["email"] = $this->model_users->is_encrypt_valid($encrypt)){
			$this->load->view('resetpassword',$data);
		} else {
			echo "Invalid Key";
		}
	}
	
	public function update_password(){
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|trim|xss_clean');
		$this->form_validation->set_rules('password','Password','required|trim');
		$this->form_validation->set_rules('cpassword','Confirm Password','required|trim|matches[password]');
		
		if($this->form_validation->run()){
			$this->load->model('model_users');
			if($this->model_users->update_user_password()){
				$this->model_users->user_audit_log("RESET PASSWORD",$this->input->post('email'),date("Y-m-d H:i:s",time()));
				echo "Your password has been reset successfully !!";
			} else {
				echo "Could not reset password!";
			}
		}else{
			$data["email"] = $this->input->post('email');
			$this->load->view('resetpassword',$data);
		}
	}
	
	public function update_profile(){
		if($this->session->userdata('is_logged_in')){
			$email = $this->input->post("email",true);
			$full_name = $this->input->post("full_name",true);
			$date_of_birth = $this->input->post("date_of_birth",true);
			$place_of_birth = $this->input->post("place_of_birth",true);
			$data = array("full_name"=>$full_name,"date_of_birth"=>$date_of_birth,"place_of_birth"=>$place_of_birth);
			if($this->db->where("email",$email)->update("users",$data)){
				$this->load->model('model_users');
				$this->model_users->user_audit_log("UPDATE PROFILE",$this->session->userdata('email'),date("Y-m-d H:i:s",time()));
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Data has been saved successfully.
			</div>
			<?php
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
	
	public function update_profile_password(){
		if($this->session->userdata('is_logged_in')){
			$email = $this->input->post("email",true);
			$password = $this->input->post("password",true);
			$data = array("password"=>$password);
			if($this->db->where("email",$email)->update("users",$data)){
				$this->load->model('model_users');
				$this->model_users->user_audit_log("UPDATE PASSWORD",$this->session->userdata('email'),date("Y-m-d H:i:s",time()));
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> Data has been saved successfully.
			</div>
			<?php
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
	
	public function update_profile_photo(){
		$email = $this->input->post("email",true);
		$config['upload_path'] = "./resources/images/";
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('image_path')){
			$error = $this->upload->display_errors();
		} else {
			$data = $this->upload->data();
			$image_path = $data['file_name'];
			$data = array("image_path"=>$image_path);
			if($this->db->where("email",$email)->update("users",$data)){
				$this->load->model('model_users');
				$this->model_users->user_audit_log("UPDATE PHOTO",$this->session->userdata('email'),date("Y-m-d H:i:s",time()));
				redirect('main/profile');
			} else {
				
			}
		}	
	}
}