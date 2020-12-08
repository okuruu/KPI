<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan_model extends CI_Model {

public function __construct()
{
		parent::__construct();
		$this->load->database();
}

	public function get()
	{
		$this->db->select('satuans.id_satuan, satuans.satuan, kpi_mcalculation.jenis_kalkulasi');
		$this->db->from('satuans');
		$this->db->join('kpi_mcalculation','kpi_mcalculation.id_kalkulasi=satuans.id_kalkulasi');
		$this->db->order_by('satuans.id_kalkulasi','DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_id($id)
	{	
		$this->db->select('satuans.id_satuan, satuans.satuan, kpi_mcalculation.id_kalkulasi,  kpi_mcalculation.jenis_kalkulasi');
		$this->db->from('satuans');
		$this->db->join('kpi_mcalculation','satuans.id_kalkulasi = kpi_mcalculation.id_kalkulasi');
		$this->db->where('id_satuan',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('satuans',$data);
	}
	public function update($id)
	{
		$data = array(
			'satuan' => $this->input->post('satuan'),
			'id_kalkulasi' => $this->input->post('id_kalkulasi')
		);
		$this->db->where('id_satuan', $id);
		$update = $this->db->update('satuans', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_satuan', $id);
		$this->db->delete('satuans');
	}
}
