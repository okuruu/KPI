<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kalkulasi_model extends CI_Model {


	public function get()
	{
				$this->db->select('*');
				$this->db->from('kpi_mcalculation');
				$query = $this->db->get();
				return $query->result();
	}

	public function get_id($id)
	{	
		$this->db->from('kpi_mcalculation');
		$this->db->where('id_kalkulasi',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('kpi_mcalculation',$data);
	}
	public function update($id)
	{
		$data = array(
			'jenis_kalkulasi' 	=> $this->input->post('jenis_kalkulasi'),
		);
		$this->db->where('id_kalkulasi', $id);
		$update = $this->db->update('kpi_mcalculation', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_kalkulasi', $id);
		$this->db->delete('kpi_mcalculation');
	}
}
