<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programkpi_model extends CI_Model {

public function __construct()
{
		parent::__construct();
		$this->load->database();
}


	public function get()
	{
		$this->db->select('programtahuns.id_programtahun, units.nama_unit, programtahuns.program_tahun');
		$this->db->from('programtahuns');
		$this->db->join('units','units.id_unit= programtahuns.id_unit');
		$this->db->order_by('programtahuns.id_programtahun', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
		public function get_id($id)
	{	
		$this->db->select('programtahuns.program_tahun, units.id_unit, units.nama_unit');
		$this->db->from('programtahuns');
		$this->db->join('units', 'programtahuns.id_unit = units.id_unit');
		$this->db->where('id_programtahun',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('programtahuns',$data);
	}
	public function update($id)
	{
		$data = array(
			'id_unit' 			=> $this->input->post('id_unit'),
			'program_tahun' 	=> $this->input->post('program_tahun'),
			
		);
		$this->db->where('id_programtahun', $id);
		$update = $this->db->update('programtahuns', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_programtahun', $id);
		$this->db->delete('programtahuns');
	}

	

}
