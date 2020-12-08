<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class unit_model extends CI_Model {


	public function get()
	{
				$this->db->select('units.id_unit, units.nama_unit, units.kode_unit, units.deskripsi');
				$this->db->from('units');
				//$this->db->order_by('units.id_unit', 'ASC');
				$query = $this->db->get();
				return $query->result();
	}

	public function get_id($id)
	{	
		$this->db->from('units');
		$this->db->where('id_unit',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('units',$data);
	}
	public function update($id)
	{
		$data = array(
			'nama_unit' => $this->input->post('nama_unit'),
			'kode_unit' => $this->input->post('kode_unit'),
			'deskripsi' => $this->input->post('deskripsi'),

		);
		$this->db->where('id_unit', $id);
		$update = $this->db->update('units', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_unit', $id);
		$this->db->delete('units');
	}
}
