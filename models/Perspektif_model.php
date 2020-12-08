<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perspektif_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get()
	{
		$this->db->select('perspektifs.id_perspektif, perspektifs.perspektif, perspektifs.urutan');
		$this->db->from('perspektifs');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_id($id)
	{	
		$this->db->from('perspektifs');
		$this->db->where('id_perspektif',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('perspektifs',$data);
	}
	public function update($id)
	{
		$data = array(
			'urutan'		=> $this->input->post('urutan'),
			'perspektif' 	=> $this->input->post('perspektif'),
		);
		$this->db->where('id_perspektif', $id);
		$update = $this->db->update('perspektifs', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_perspektif', $id);
		$this->db->delete('perspektifs');
	}
}
