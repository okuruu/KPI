<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria_model extends CI_Model {

	public function get()
	{
		$this->db->select('*');
		$this->db->from('kriterias');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_id($id)
	{	
		$this->db->from('kriterias');
		$this->db->where('id_kriteria',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('kriterias',$data);
	}
	public function update($id)
	{
		$data = array(
			'range_atas' => $this->input->post('range_atas'),
			'range_bawah' => $this->input->post('range_bawah'),
			'presentase' => $this->input->post('presentase'),
		);
		$this->db->where('id_satuan', $id);
		$update = $this->db->update('satuans', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_kriteria', $id);
		$this->db->delete('kriterias');
	}
}
