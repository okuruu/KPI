<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class User extends CI_Controller {
//include('AuthController.php');

include(dirname(__FILE__).DIRECTORY_SEPARATOR."AuthController.php");

class User extends AuthController{

	public function __construct()
	{
		
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('User_model');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}
		
	}
	public function index()
	{
		$data['data'] = $this->User_model->get();
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/user/user',$data);
		$this->load->view('admin/_partials/footer');
	}
	public function insert()
	{
		$this->form_validation->set_rules('nama','Nama',"required");
		$this->form_validation->set_rules('alamat','Alamat',"required|trim");
		$this->form_validation->set_rules('email','Email',"required|trim");
		$this->form_validation->set_rules('username','Username',"required|alpha_numeric|trim");
		$this->form_validation->set_rules('password','Password',"required|min_length[6]|trim");
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/user/insert');
			$this->load->view('admin/_partials/footer');
		} else {
			$this->User_model->insert();
			redirect('admin/user','refresh');
		}
	}
	public function update($id)
	{
		$this->form_validation->set_rules('nama','Nama',"required");
		$this->form_validation->set_rules('alamat','Alamat',"required|trim");
		$this->form_validation->set_rules('email','Email',"required|trim");
		$this->form_validation->set_rules('username','Username',"required|alpha_numeric|trim");
		$this->form_validation->set_rules('password','Password',"required|min_length[6]|trim");
		
		if ($this->form_validation->run() == FALSE) {
			$data['users'] = $this->User_model->get_id($id);
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/user/update',$data);
			$this->load->view('admin/_partials/footer');
		} else {
			$this->User_model->update($id);
			redirect('admin/user','refresh');
		}
	}
	public function delete($id)
	{
		$this->User_model->delete($id);
		redirect('admin/user','refresh');
	}
}
