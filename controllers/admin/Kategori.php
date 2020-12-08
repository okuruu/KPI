<?php
defined('BASEPATH') OR exit('No direct script access allowed');


include(dirname(__FILE__).DIRECTORY_SEPARATOR."AuthController.php");
class Kategori extends AuthController {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Kategori_model');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}
		
			}
	public function index()
	{
		$data['data'] = $this->Kategori_model->get();
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/kategori/kategori',$data);
		$this->load->view('admin/_partials/footer');
	}
	public function insert()
	{
		$this->form_validation->set_rules('kategori','Kategori',"required");
		//$this->form_validation->set_rules('deskripsi','Deskripsi',"required");
		$this->form_validation->set_rules('urutan','Urutan',"required");
		
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/kategori/insert');
			$this->load->view('admin/_partials/footer');
		} else {
			$data = array(
			'id_kategori'=> $this->input->post('id_kategori'),
			'kategori' 	=> $this->input->post('kategori'),
			
			'urutan'	=> $this->input->post('urutan'),
			);
			$this->Kategori_model->insert($data);
			redirect('admin/kategori','refresh');
		}
	}
	public function update($id)
	{
		$this->form_validation->set_rules('kategori','Kategori',"required");
		
		$this->form_validation->set_rules('urutan','Urutan',"required");
		if ($this->form_validation->run() == FALSE) {
			$data['kategoris'] = $this->Kategori_model->get_id($id);
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/kategori/update',$data);
			$this->load->view('admin/_partials/footer');
		} else {
			$this->Kategori_model->update($id);
			redirect('admin/kategori','refresh');
		}
	}
	public function delete($id)
	{
		$this->Kategori_model->delete($id);
		redirect('admin/kategori','refresh');
	}
}