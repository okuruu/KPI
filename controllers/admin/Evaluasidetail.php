<?php

defined('BASEPATH') OR exit('No direct script access allowed');


include(dirname(__FILE__).DIRECTORY_SEPARATOR."AuthController.php");
class Evaluasidetail extends AuthController {

	public function __construct()

	{

		parent::__construct();
		$this->load->model('Evaluasidetail_model');
		$this->load->library('form_validation');

				if($this->session->userdata('status') != "login"){
			redirect(base_url("index.php/login"));

		}

	}



	public function index()

	{	
	
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotifcustom.php");
		$this->load->view("admin/_partials/pemisah.php");
		//$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/_partials/footer');
		//$data['data'] = $this->Evaluasidetail_model->get();
		//$data['jumlah'] = $this->Evaluasidetail_model->get_jumlah();
		//$data['kali'] = $this->Evaluasidetail_model->get_kali();
		//$data['perkalian'] = $this->Evaluasidetail_model->get_perkalian();
		//$this->load->view('admin/evaluasidetail/evaluasidetail',$data); 
	} 



	public function detail($id_evaluasi)

	{
		$data['data'] = $this->Evaluasidetail_model->get($id_evaluasi);
		/*
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		exit;
		*/
		$this->load->view("admin/_partials/title.php");
		$this->load->view("admin/_partials/headernotifcustom.php");
		$this->load->view("admin/_partials/pemisah.php");
		//$this->load->view("admin/_partials/sidebar.php");
		$this->load->view('admin/evaluasidetail/evaluasidetail',$data);
		$this->load->view('admin/_partials/footer');
	}

	//Data User Tambah

	public function insert($id_evaluasi)

	{

		//validasi input

		$this->form_validation->set_rules('no','No');
		$this->form_validation->set_rules('id_perspektif','Perspektif',"required");
		$this->form_validation->set_rules('indikator','Indikator',"required");
		$this->form_validation->set_rules('sub_bobot','Sub_bobot', "required");
		$this->form_validation->set_rules('id_satuan','id_satuan',"required");
		$this->form_validation->set_rules('target','Target',"required");
		$this->form_validation->set_rules('realisasi','Realisasi',"required");
		$this->form_validation->set_rules('kinerja_maks','Kinerja Maksimal',"required");
		$this->form_validation->set_rules('tidak_tercapai','Tidak Tercapai',"required");
		$this->form_validation->set_rules('rtl','RTL',"required");
		$this->form_validation->set_rules('waktu_pj','Waktu PJ',"required");
		$this->form_validation->set_rules('nilai_prestasi','Nilai Prestasi',"required");
		$this->form_validation->set_rules('pencapaian_kinerja','Pencapaian Kinerja',"required");
		$this->form_validation->set_rules('keterangan','Keterangan',"required");

			if ($this->form_validation->run() == FALSE) {

				$this->load->view("admin/_partials/title.php");
				$this->load->view("admin/_partials/headernotifcustom.php");
				$this->load->view("admin/_partials/pemisah.php");
				$this->load->view("admin/_partials/sidebar.php");
				$this->load->view('admin/evaluasidetail/insert');
				$this->load->view('admin/_partials/footer');

			} else {		

		

				$data = array(

				'no'					=> $this->input->post('no'),
				'id_perspektif'			=> $this->input->post('id_perspektif'),
				'id_kategori'			=> $this->input->post('id_kategori'),
				'indikator'				=> $this->input->post('indikator'),
				'sub_bobot'				=> $this->input->post('sub_bobot'),
				'id_satuan'				=> $this->input->post('id_satuan'),
				'target'				=> $this->input->post('target'),
				'realisasi'				=> $this->input->post('realisasi'),
				'kinerja_maks'			=> $this->input->post('kinerja_maks'),
				'tidak_tercapai'		=> $this->input->post('tidak_tercapai'),
				'rtl'					=> $this->input->post('rtl'),
				'waktu_pj'				=> $this->input->post('waktu_pj'),
				'nilai_prestasi'		=> $this->input->post('nilai_prestasi'),
				'pencapaian_kinerja'	=> $this->input->post('pencapaian_kinerja'),
				'keterangan'			=> $this->input->post('keterangan'),
				'id_evaluasi'			=> $id_evaluasi,

					);

				$this->Evaluasidetail_model->insert($data);
				redirect('admin/evaluasidetail/'.$id_evaluasi,'refresh');
			}

	}

	//EDIT USER//

	public function update($id_evaluasi)

	{
		$this->form_validation->set_rules('no','No');
		$this->form_validation->set_rules('indikator','Indikator');
		$this->form_validation->set_rules('sub_bobot','Sub_bobot', "required");
		$this->form_validation->set_rules('id_satuan','id_satuan');
		$this->form_validation->set_rules('target','Target',"required");
		$this->form_validation->set_rules('realisasi','Realisasi',"required");
		$this->form_validation->set_rules('kinerja_maks','Kinerja Maksimal',"required");
		$this->form_validation->set_rules('tidak_tercapai','Tidak Tercapai');
		$this->form_validation->set_rules('nilai_prestasi','Nilai Prestasi');
		$this->form_validation->set_rules('rtl','RTL');
		$this->form_validation->set_rules('waktu_pj','Waktu PJ');
		$this->form_validation->set_rules('pencapaian_kinerja','Pencapaian Kinerja',"required");
		$this->form_validation->set_rules('keterangan','Keterangan',"required");
		

		if ($this->form_validation->run() == FALSE) {

			$data['evaluasidetails'] = $this->Evaluasidetail_model->get_id($id_evaluasi);

			$this->load->view("admin/_partials/title.php");
			$this->load->view("admin/_partials/headernotif.php");
			$this->load->view("admin/_partials/pemisah.php");
			$this->load->view("admin/_partials/sidebar.php");
			$this->load->view('admin/evaluasidetail/update',$data);
			$this->load->view('admin/_partials/footer');
			
		} else {
			$this->Evaluasidetail_model->update($id_evaluasi);
			redirect('admin/evaluasidetail/update/'.$id_evaluasi,'refresh');
		}

	}

	//Enda masuk database

//Delete ser Admin

	public function delete($id)
	{
		/*echo '<pre>';
		print_r($id_evaluasi);
		echo '</pre>';
		exit; */
		$this->Evaluasidetail_model->delete($id);
		redirect('admin/evaluasi','refresh');
		
	}

}