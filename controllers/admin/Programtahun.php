<?php
defined('BASEPATH') OR exit('No direct script access allowed');


include(dirname(__FILE__).DIRECTORY_SEPARATOR."AuthController.php");
class Programtahun extends AuthController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Programtahun_model');
		$this->load->library('form_validation');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}

	}

	public function index()
	{	$data['data'] = $this->Programtahun_model->get();
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/programtahun/programtahun',$data);
		$this->load->view('admin/_partials/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input
		$this->form_validation->set_rules('id_unit','Nama_unit',"required");
		$this->form_validation->set_rules('program_tahun','Program_tahun',"required");
		
		if ($this->form_validation->run() == FALSE) {
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/programtahun/insert');
		$this->load->view('admin/_partials/footer');
		} else {
			$data = array(
			'id_unit' 			=> $this->input->post('id_unit'),
			'program_tahun' 	=> $this->input->post('program_tahun'),
			);
			$this->Programtahun_model->insert($data);
			redirect('admin/programtahun','refresh');
		}
	}

	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('id_unit','Nama_unit',"required");
		$this->form_validation->set_rules('program_tahun','Program_tahun',"required");

		if ($this->form_validation->run() == FALSE) {
			$data['programtahuns'] = $this->Programtahun_model->get_id($id);
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/programtahun/update',$data);
		$this->load->view('admin/_partials/footer');
		} else {
			$this->Programtahun_model->update($id);
			redirect('admin/programtahun','refresh');
		}
	}
	//Enda masuk database	


//Delete ser Admin
	public function delete($id)
	{
	$this->Programtahun_model->delete($id);
		redirect('admin/programtahun','refresh');
	}

}
