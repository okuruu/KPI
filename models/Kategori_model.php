<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

	var $table = 'kategoris';

	public function __construct()
{
		parent::__construct();
		$this->load->database();
}

	public function get()
	{	
		
		/*
		$this->db->select('kategoris.id_kategori, kategoris.kategori, kategoris.urutan');
		$this->db->from('kategoris');
		$this->db->order_by('kategoris.id_kategori','ASC');
		$query = $this->db->get();
		echo $this->db->last_query();
		exit;
		*/
		$query = $this->db->query('
			SELECT 
				"kategoris"."id_kategori", 
				"kategoris"."kategori", 
				"kategoris"."urutan" 
			FROM "kategoris" 
			WHERE "kategoris"."code" = \'EDITABLE\'
			ORDER BY "kategoris"."id_kategori" ASC
		');
		return $query->result();
	}

	public function get_id($id)
	{	
		$query = $this->db->query('
			SELECT 
				* 
			FROM "kategoris" 
			WHERE "kategoris"."id_kategori" = '.$id.'
			ORDER BY "kategoris"."id_kategori" ASC
		');
		
		/*
		$this->db->from('kategoris.id_kategori, kategoris.ketegori, kategoris.urutan');
		$this->db->where('id_kategori',$id);
		$query = $this->db->get();
		*/
		return $query->row();
	}
	
	public function insert($data)
	{

		$this->db->insert('kategoris',$data);
	}
	public function update($id)
	{
		$data = array(
			'kategori' => $this->input->post('kategori'),
			
			'urutan' 	=> $this->input->post('urutan'),
		);
		$this->db->where('id_kategori', $id);
		$update = $this->db->update('kategoris', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_kategori', $id);
		$this->db->delete('kategoris');
	}
}
