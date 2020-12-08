<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programkpi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Programkpi_model');

	}

	public function index()
	{	$data['data'] = $this->Programkpi_model->get();
		$this->load->view('admin/header');
		$this->load->view('admin/programkpi/programkpi',$data);
		$this->load->view('admin/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input
		$this->form_validation->set_rules('id_unit','Nama_unit',"required");
		$this->form_validation->set_rules('program_tahun','Program_tahun',"required");
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/header');
			$this->load->view('admin/programkpi/insert');
			$this->load->view('admin/footer');
		} else {
			$data = array(
			'id_unit' 			=> $this->input->post('id_unit'),
			'program_tahun' 	=> $this->input->post('program_tahun'),
			);
			$this->Programkpi_model->insert($data);
			redirect('Admin/Programkpi','refresh');
		}
	}


//Delete ser Admin
	public function delete($id)
	{
	$this->Programkpi_model->delete($id);
		redirect('Admin/Programkpi','refresh');
	}

}