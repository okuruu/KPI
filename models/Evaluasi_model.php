<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasi_model extends CI_Model {
	

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
	}

	public function get()
	{
		$this->db->select('evaluations.id_evaluasi, units.nama_unit,  evaluations.tahun, bulans.bulan');
		$this->db->from('evaluations');
		$this->db->join('units','units.id_unit = evaluations.id_unit');
		$this->db->join('bulans','bulans.id_bulan= evaluations.id_bulan');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_id($id)
	{	
		$this->db->select('evaluations.id_evaluasi, units.nama_unit, evaluations.tahun, bulans.bulan');
		$this->db->from('evaluations');
		$this->db->join('units', 'evaluations.id_unit = units.id_unit');
		$this->db->join('bulans','evaluations.id_bulan = bulans.id_bulan');
		$this->db->where('id_evaluasi',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{
		$this->db->insert('evaluations',$data);
	}
	
	public function insertDetailEval($data){
		
		$query = $this->db->query("
			SELECT * FROM \"evaluations\" 
				WHERE \"id_unit\" = '".$data['id_unit'].
						"' AND \"id_bulan\"='".$data['id_bulan'].
						"' AND \"tahun\"='".$data['tahun']."'");
						
		$line = $query->row();
		
		$query = $this->db->query("
			SELECT 
				PD.\"id_programdetail\",
				PD.\"id_perspektif\",
				PD.\"id_kategori\",
				PD.\"id_satuan\",
				PD.\"sub_bobot\",
				PD.\"indikator\",
			  PD.\"target\",
			  PD.\"no\"
						 
			FROM \"programtahuns\" PT 
			LEFT OUTER JOIN \"programdetails\" PD ON PD.\"id_programtahun\" = PT.\"id_programtahun\"
			WHERE PT.\"id_unit\" = '".$data['id_unit']."' AND PT.\"program_tahun\"='".$data['tahun']."'
		");
		$arrProgramDetails = $query->result();
		
		foreach($arrProgramDetails as $programdetail){
			$data = array(
				'no'				=> $programdetail->no,
				'id_programdetail'	=> $programdetail->id_programdetail,
				'id_perspektif'		=> $programdetail->id_perspektif,
				'id_kategori' 		=> $programdetail->id_kategori,
				'indikator' 		=> $programdetail->indikator,
				'sub_bobot' 		=> $programdetail->sub_bobot,
				'id_satuan' 		=> $programdetail->id_satuan,
				'target' 			=> $programdetail->target,
				'id_evaluasi'		=> $line->id_evaluasi
			);
			//echo "<pre>";
			//print_r($data);
			//echo "</pre>";
			$this->db->insert('evaluasidetails', $data);
		}
	
	}
	
	public function update($id)
	{
		$data = array(
			'id_unit' 		=> $this->input->post('id_unit'),
			'id_bulan' 		=> $this->input->post('id_bulan'),
			'tahun' 		=> $this->input->post('tahun'),
		);
		$this->db->where('id_evaluasi', $id);
		$update = $this->db->update('evaluations', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_evaluasi', $id);
		$this->db->delete('evaluations');
	}
}
