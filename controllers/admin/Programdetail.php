<?php
defined('BASEPATH') OR exit('No direct script access allowed');


include(dirname(__FILE__).DIRECTORY_SEPARATOR."AuthController.php");
class Programdetail extends AuthController {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('Programdetail_model');
		
				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));
		}

	}

	public function index()
	{	/*
		$data['data'] = $this->Programdetail_model->get(0);
		$data['jumlah'] = $this->Programdetail_model->get_jumlah();
		*/
		//$data['tampil'] = $this->Programdetail_model->get_tampil();
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		//$this->load->view('admin/programdetail/programdetail',$data);
		$this->load->view('admin/_partials/footer');
	} 
	
	public function detail($id_programtahun){
		
		$data['data'] = $this->Programdetail_model->get($id_programtahun);
			//echo "<pre>";
			//print_r($data);
			//echo "</pre>";
			//exit;
		/*
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		exit;
		*/
		//$data['apapun'] = "Hello Nurma!";
		//$data['jumlah'] = $this->Programdetail_model->get_jumlah($id_programtahun);
		
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotif.php");
		$this->load->view("admin/_partials/pemisah.php");
		$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/programdetail/programdetail',$data);
		//echo 'ini detailnya id pr :'.$code.' dan tahun :'.$tahun;
		$this->load->view('admin/_partials/footer');
	}

	public function insert($id_programtahun)
	//public function insert($id_programtahun)
	{
		//validasi input
	
		$this->form_validation->set_rules('no','No');
		$this->form_validation->set_rules('id_perspektif','Perspektif',"required");
		$this->form_validation->set_rules('id_kategori','Deskripsi');
		$this->form_validation->set_rules('indikator','Indikator',"required");
		$this->form_validation->set_rules('sub_bobot','Sub_bobot',"required");
		$this->form_validation->set_rules('id_satuan','Satuan',"required");
		$this->form_validation->set_rules('target','Target',"required");
		//$this->form_validation->set_rules('id_programtahun','Tahun');
		$this->form_validation->set_rules('keterangan','keterangan');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/programdetail/insert');
			$this->load->view('admin/_partials/footer');
		} else {
			$data = array(
			'no'				=> $this->input->post('no'),
			'id_perspektif'		=> $this->input->post('id_perspektif'),
			'id_kategori' 		=> $this->input->post('id_kategori'),
			'indikator' 		=> $this->input->post('indikator'),
			'sub_bobot' 		=> $this->input->post('sub_bobot'),
			'id_satuan' 		=> $this->input->post('id_satuan'),
			'target' 			=> $this->input->post('target'),
			'keterangan' 		=> $this->input->post('keterangan'),
			'id_programtahun'	=> $id_programtahun,
			);
			$this->Programdetail_model->insert($data);
			redirect('admin/programdetail/detail/'.$id_programtahun,'refresh');
		}
	}


	
	//EDIT USER//
	public function update($id)
	{
		$this->form_validation->set_rules('no','No');
		$this->form_validation->set_rules('id_perspektif','Perspektif',"required");
		$this->form_validation->set_rules('id_kategori','Deskripsi');
		$this->form_validation->set_rules('indikator','Indikator',"required");
		$this->form_validation->set_rules('sub_bobot','Sub_bobot',"required");
		$this->form_validation->set_rules('id_satuan','Satuan',"required");
		$this->form_validation->set_rules('target','Target',"required");
		$this->form_validation->set_rules('keterangan','keterangan');
		//$this->form_validation->set_rules('id_programtahun','tahun');
		$data['programdetails'] = $this->Programdetail_model->get_id($id);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/programdetail/update',$data);
			$this->load->view('admin/_partials/footer');
		} else {
			$this->Programdetail_model->update($id);
			redirect('admin/programdetail/detail/'.$data['programdetails']->id_programtahun,'refresh');
		}
	}
	//Enda masuk database	


//Delete ser Admin
	public function delete($id)
	{
		$this->Programdetail_model->delete($id);
		redirect('admin/programdetail/detail/'.$id_programtahun,'refresh');
	}

}