<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->library('form_validation');
		$this->load->model('Kriteria_model');
		//if($this->session->userdata('logged_in') == null){
		//	redirect('Login','refresh');
		//}
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}
		

	}

	public function index()
	{	$data['data'] = $this->Kriteria_model->get();
		$this->load->view('admin/header');
		$this->load->view('admin/kriteria/kriteria',$data);
		//$this->load->view('admin/index',$data);
		$this->load->view('admin/footer');
	}

	//Data User Tambah
	public function insert()
	{
		//validasi input
		$this->form_validation->set_rules('range_atas','Range_atas',"required");
		$this->form_validation->set_rules('range_bawah','Range_bawah',"required");
		$this->form_validation->set_rules('presentase','presentase',"required");

		//$this->form_validation->set_rules('deskripsi','Deskripsi',"required");

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/header');
			$this->load->view('admin/kriteria/insert');
			$this->load->view('admin/footer');
		} else {
			$data = array(
			'range_atas' 	=> $this->input->post('range_atas'),
			'range_bawah' 	=> $this->input->post('range_bawah'),
			'presentase' 	=> $this->input->post('presentase'),
			);
			$this->Kriteria_model->insert($data);
			redirect('Admin/Kriteria','refresh');
		}
	}

	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('range_atas','Range_atas',"required");
		$this->form_validation->set_rules('range_bawah','Range_bawah',"required");
		$this->form_validation->set_rules('presentase','presentase',"required");
		
		if ($this->form_validation->run() == FALSE) {
			$data['kriterias'] = $this->Kriteria_model->get_id($id);
			$this->load->view('admin/header');
			$this->load->view('admin/kriteria/update',$data);
			$this->load->view('admin/footer');
		} else {
			$this->Kriteria_model->update($id);
			redirect('Admin/Kriteria','refresh');
		}
	}
	//Enda masuk database	


//Delete ser Admin
	public function delete($id)
	{
	$this->Unit_model->delete($id);
		redirect('Admin/Kriteria','refresh');
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
