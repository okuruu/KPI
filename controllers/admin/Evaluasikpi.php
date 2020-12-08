<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasikpi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Evaluasikpi_model');

	}

	public function index()
	{	$data['data'] = $this->Evaluasikpi_model->get();
		$this->load->view('admin/header');
		$this->load->view('admin/evaluasikpi/evaluasikpi',$data);
		$this->load->view('admin/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input
		$this->form_validation->set_rules('nama_bulan','Bulan',"required");

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/header');
			$this->load->view('admin/evaluasikpi/insert');
			$this->load->view('admin/footer');
		} else {
			$data = array(
			'id' 			=> $this->input->post('id'),
			'nama_bulan' 	=> $this->input->post('nama_bulan'),
			);
			$this->Evaluasikpi_model->insert($data);
			redirect('Admin/Evaluasikpi','refresh');
		}
	}

	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('nama_bulan','Bulan',"required");
		
		if ($this->form_validation->run() == FALSE) {
			$data['try'] = $this->Evaluasikpi_model->get_id($id);
			$this->load->view('admin/header');
			$this->load->view('admin/evaluasikpi/update',$data);
			$this->load->view('admin/footer');
		} else {
			$this->Evaluasikpi_model->update($id);
			redirect('Admin/Evaluasikpi','refresh');
		}
	}
	//Enda masuk database	


//Delete ser Admin
	public function delete($id)
	{
	$this->Evaluasikpi_model->delete($id);
		redirect('Admin/Evaluasikpi','refresh');
	}

}

/*defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller
{
	//Load Model
	

	//Data User Admin
	public function index()
	{
		$data['data'] = $this->Unit_model->get();
		$this->load->view('admin/header');
		$this->load->view('admin/unit/unit',$data);
		$this->load->view('admin/footer');
	}
	
	//Enda masuk database


/
}
*/
