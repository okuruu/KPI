<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class unit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('unit_model');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}

	}

	public function index()
	{	$data['data'] = $this->unit_model->get();
		$this->load->view('admin/_partials/headernotif.php');
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/unit/unit',$data);
		$this->load->view('admin/_partials/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input
		$this->form_validation->set_rules('nama_unit','Nama unit',"required");
		$this->form_validation->set_rules('kode_unit','Kode unit',"required");
		$this->form_validation->set_rules('deskripsi','Deskripsi',"required");

		if ($this->form_validation->run() == FALSE) {
		$this->load->view('admin/_partials/headernotif.php');
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/unit/insert');
		$this->load->view('admin/_partials/footer');
		} else {
			$data = array(
			'id_unit' 			=> $this->input->post('id_unit'),
			'nama_unit' 		=> $this->input->post('nama_unit'),
			'kode_unit' 		=> $this->input->post('kode_unit'),
			'deskripsi' 		=> $this->input->post('deskripsi'),
			);
			$this->unit_model->insert($data);
			redirect('admin/unit','refresh');
		}
	}

	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('nama_unit','Nama unit',"required");
		$this->form_validation->set_rules('kode_unit','Kode unit',"required");
		$this->form_validation->set_rules('deskripsi','Deskripsi',"required");
		
		if ($this->form_validation->run() == FALSE) {
			$data['units'] = $this->unit_model->get_id($id);
		$this->load->view('admin/_partials/headernotif.php');
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/unit/update',$data);
		$this->load->view('admin/_partials/footer');
		} else {
			$this->unit_model->update($id);
			redirect('admin/unit','refresh');
		}
	}
	//Enda masuk database	


//Delete ser admin
	public function delete($id)
	{
	$this->unit_model->delete($id);
		redirect('admin/unit','refresh');
	}

}

/*defined('BASEPATH') OR exit('No direct script access allowed');

class unit extends CI_Controller
{
	//Load Model
	

	//Data User admin
	public function index()
	{
		$data['data'] = $this->unit_model->get();
		$this->load->view('admin/header');
		$this->load->view('admin/unit/unit',$data);
		$this->load->view('admin/footer');
	}
	
	//Enda masuk database


/
}
*/
