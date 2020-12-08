<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detailprogram_model extends CI_Model {
var $table = 'kpi_programdetail';
public function __construct()
{
		parent::__construct();
		$this->load->database();
}


	public function get()
	{
		$this->db->select('kpi_programdetail.id_detailprogram, kpi_programdetail.indikator, kpi_programdetail.sub_bobot, satuans.satuan, kpi_programdetail.target, kpi_programdetail.keterangan');
		$this->db->from('kpi_programdetail');
		$this->db->join('satuans','satuans.id_satuan= kpi_programdetail.id_satuan');
		$this->db->order_by('kpi_programdetail.id_detailprogram', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
		public function get_id($id)
	{	
		$this->db->select('kpi_programdetail.id_detailprogram, kpi_programdetail.indikator, kpi_programdetail.sub_bobot, satuans.satuan, kpi_programdetail.target, kpi_programdetail.keterangan');
		$this->db->from('kpi_programdetail');
		$this->db->join('satuans', 'kpi_programdetail.id_satuan = satuans.id_satuan');
		
		$this->db->where('id_detailprogram',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('kpi_programdetail',$data);
	}
	public function update($id)
	{
		$data = array(
			'indikator'			=> $this->input->post('indikator'),
			'sub_bobot'			=> $this->input->post('sub_bobot'),
			'id_satuan' 		=> $this->input->post('id_satuan'),
			'target' 			=> $this->input->post('target'),
			'keterangan'		=> $this->input->post('keterangan'),
			
		);
		$this->db->where('id_detailprogram', $id);
		$update = $this->db->update('kpi_programdetail', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_detailprogram', $id);
		$this->db->delete('kpi_programdetail');
	}

}
