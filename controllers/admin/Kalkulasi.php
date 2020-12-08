<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalkulasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Kalkulasi_model');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}

	}

	public function index()
	{	$data['data'] = $this->Kalkulasi_model->get();
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/kalkulasi/kalkulasi',$data);
		$this->load->view('admin/_partials/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input
		$this->form_validation->set_rules('jenis_kalkulasi','Jenis_kalkulasi',"required");

		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/kalkulasi/insert');
			$this->load->view('admin/_partials/footer');
		} else {
			$data = array(
			'id_kalkulasi'	 	=> $this->input->post('id_kalkulasi'),
			'jenis_kalkulasi' 		=> $this->input->post('jenis_kalkulasi'),
			);
			$this->Kalkulasi_model->insert($data);
			redirect('admin/kalkulasi','refresh');
		}
	}

	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('jenis_kalkulasi','Jenis_kalkulasi',"required");
		
		if ($this->form_validation->run() == FALSE) {
			$data['kpi_mcalculation'] = $this->Kalkulasi_model->get_id($id);
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/kalkulasi/update',$data);
			$this->load->view('admin/_partials/footer');
		} else {
			$this->Kalkulasi_model->update($id);
			redirect('admin/kalkulasi','refresh');
		}
	}
	//Enda masuk database	


//Delete ser Admin
	public function delete($id)
	{
	$this->Kalkulasi_model->delete($id);
		redirect('admin/kalkulasi','refresh');
	}

}