<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasikpi_model extends CI_Model {


	public function get()
	{
				$this->db->select('*');
				$this->db->from('try');
				$query = $this->db->get();
				return $query->result();
	}

	public function get_id($id)
	{	
		$this->db->select('*');
		$this->db->from('try');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('try',$data);
	}
	public function update($id)
	{
		$data = array(
			'id' 	=> $this->input->post('id'),
			'nama_bulan' => $this->input->post('nama_bulan'),
		);
		$this->db->where('id', $id);
		$update = $this->db->update('try', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('nama_bulan');
	}
}
