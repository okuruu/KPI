<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Evaluasi_model');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}

	}

	public function index()
	{	$data['data'] = $this->Evaluasi_model->get();
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/evaluasi/evaluasi',$data);
		$this->load->view('admin/_partials/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input
		$this->form_validation->set_rules('id_unit','Nama_unit',"required");
		$this->form_validation->set_rules('id_bulan','Bulan',"required");
		$this->form_validation->set_rules('tahun','tahun',"required");
				
		if ($this->form_validation->run() == FALSE) {
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/evaluasi/insert');
		$this->load->view('admin/_partials/footer');
		} else {
			$data = array(
			'id_unit' 	=> $this->input->post('id_unit'),
			'id_bulan'	=> $this->input->post('id_bulan'),
			'tahun' 	=> $this->input->post('tahun'),
			);
			
			$this->Evaluasi_model->insert($data);
			$this->Evaluasi_model->insertDetailEval($data);
			
			redirect('admin/evaluasi','refresh');
		}
	}

	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('id_unit','Nama Unit',"required");
		$this->form_validation->set_rules('id_bulan','Bulan',"required");
		$this->form_validation->set_rules('tahun','Bulan',"required");


		if ($this->form_validation->run() == FALSE) {
			$data['evaluations'] = $this->Evaluasi_model->get_id($id);
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/evaluasi/update',$data);
		$this->load->view('admin/_partials/footer');
		} else {
			$this->Evaluasi_model->update($id);
			redirect('admin/evaluasi','refresh');
		}
	}
	//Enda masuk database	


//Delete ser Admin
	public function delete($id)
	{
	$this->Evaluasi_model->delete($id);
		redirect('admin/evaluasi','refresh');
	}

}
