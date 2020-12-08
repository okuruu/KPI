<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include(dirname(__FILE__).DIRECTORY_SEPARATOR."AuthController.php");
class Perspektif extends AuthController {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Perspektif_model');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}

	}

	public function index()
	{	$data['data'] = $this->Perspektif_model->get();
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/perspektif/perspektif',$data);
		$this->load->view('admin/_partials/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input
		$this->form_validation->set_rules('urutan','Urutan',"required");
		$this->form_validation->set_rules('perspektif','Persprektif',"required");
		
		if ($this->form_validation->run() == FALSE) {
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/perspektif/insert');
		$this->load->view('admin/_partials/footer');
		} else {
			$data = array(
			'id_perspektif' => $this->input->post('id_perspektif'),
			'urutan' 		=> $this->input->post('urutan'),
			'perspektif' 	=> $this->input->post('perspektif'),
			);
			$this->Perspektif_model->insert($data);
			redirect('admin/perspektif','refresh');
		}
	}

	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('urutan','Urutan',"required");
		$this->form_validation->set_rules('perspektif','Perspektif',"required");
		
		if ($this->form_validation->run() == FALSE) {
			$data['perspektifs'] = $this->Perspektif_model->get_id($id);
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/perspektif/update',$data);
			$this->load->view('admin/_partials/footer');
		} else {
			$this->Perspektif_model->update($id);
			redirect('admin/perspektif','refresh');
		}
	}
	//Enda masuk database	


//Delete ser Admin
	public function delete($id)
	{
	$this->Perspektif_model->delete($id);
		redirect('admin/perspektif','refresh');
	}

}
