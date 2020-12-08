<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include(dirname(__FILE__).DIRECTORY_SEPARATOR."AuthController.php");
class Satuan extends AuthController {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Satuan_model');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}
		
	}

	public function index()
	{	$data['data'] = $this->Satuan_model->get();
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/satuan/satuan',$data);
		$this->load->view('admin/_partials/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input

		$this->form_validation->set_rules('satuan','Satuan',"required");
		$this->form_validation->set_rules('id_kalkulasi','Jenis_kalkulasi',"required");

		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/satuan/insert');
			$this->load->view('admin/_partials/footer');
		} else {
			$data = array(
			'id_satuan'		=> $this->input->post('id_satuan'),
			'satuan' 		=> $this->input->post('satuan'),
			'id_kalkulasi' 	=> $this->input->post('id_kalkulasi'),
			);
			$this->Satuan_model->insert($data);
			redirect('admin/satuan','refresh');
		}
	}

	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('satuan','Satuan',"required");
		$this->form_validation->set_rules('id_kalkulasi','Jenis_kalkulasi',"required");
		
		if ($this->form_validation->run() == FALSE) {
			$data['satuans'] = $this->Satuan_model->get_id($id);
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/satuan/update',$data);
			$this->load->view('admin/_partials/footer');
		} else {
			$this->Satuan_model->update($id);
			redirect('admin/satuan','refresh');
		}
	}
	//Enda masuk database	


//Delete ser Admin
	public function delete($id)
	{
	$this->Satuan_model->delete($id);
		redirect('admin/satuan','refresh');
	}

}
