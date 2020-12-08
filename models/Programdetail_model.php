<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Programdetail_model extends CI_Model {

	public function get($id_programtahun)
	{
		
		
		// get data program details
		$query = $this->db->query('
			SELECT 
					"perspektifs"."perspektif", 
					"programdetails"."no", 
					"programdetails"."id_programdetail", 
					"programdetails"."id_programtahun",
					"programdetails"."id_perspektif",
					"programdetails"."id_kategori",
					"kategoris"."kategori", 
					"programdetails"."sub_bobot", 
					"programdetails"."indikator", 
					"satuans"."satuan", 
					"programdetails"."target", 
					"programdetails"."keterangan" 
			FROM "programdetails" 
			LEFT OUTER JOIN "kategoris" ON "kategoris"."id_kategori"="programdetails"."id_kategori" 
			LEFT OUTER JOIN "satuans" ON "satuans"."id_satuan"="programdetails"."id_satuan" 
			LEFT OUTER JOIN "perspektifs" ON "perspektifs"."id_perspektif"="programdetails"."id_perspektif" 
			WHERE "programdetails"."id_programtahun" = '.$id_programtahun.'
			ORDER BY "programdetails"."no" ASC
		');
		
		//$query = $this->db->get();
		$arrDataProgram = $query->result();
		
		$query = $this->db->query('
			SELECT * FROM "perspektifs"
		');
		$arrDataPerspektif = $query->result();
		
		
		// Get data kategory
		$query = $this->db->query('
			SELECT 
					PD."id_kategori",
					KT."kategori",
					PD."id_programtahun",
					KT."urutan",	
					PD."id_perspektif"
			FROM "programdetails" PD
			LEFT OUTER JOIN "kategoris" KT ON KT."id_kategori" = PD."id_kategori"
			WHERE PD."id_programtahun" = '.$id_programtahun.'
			GROUP BY PD."id_perspektif",PD."id_kategori",KT."kategori",KT."urutan",PD."id_programtahun"
			ORDER BY KT."urutan" ASC
		');
		$arrDataKategoris = $query->result();
		
		// Get data perspektif
		$query = $this->db->query('
			SELECT * FROM "perspektifs"
		');
		$arrDataPerspektif = $query->result();
		
		
		// get data unit and program tahun
		$query = $this->db->query('
			SELECT 
				UN."nama_unit",
				UN."kode_unit",
				PT."program_tahun",
				PT."id_programtahun"
			FROM "programtahuns" PT
			LEFT OUTER JOIN "units" UN ON UN."id_unit" = PT."id_unit"
			WHERE PT."id_programtahun" = '.$id_programtahun.'
		');
		$arrProperties = $query->result();
		
		$ArrData = array(
						"Properties"=>$arrProperties, 
						"Program"=>$arrDataProgram,
						"Kategori"=>$arrDataKategoris,
						"Perspektif"=>$arrDataPerspektif
					); 
					
		//echo "<pre>";
		//print_r($ArrData);
		//echo "</pre>";
		//exit;
		
		return $ArrData;
	}

	public function get_jumlah($id_programtahun)
	{
		$query = $this->db->query('
			SELECT "id_programdetail", SUM("sub_bobot")
				FROM "programdetails"
			WHERE "id_programtahun" = '.$id_programtahun.'
				GROUP BY "id_programdetail"

			');
		$arrJumlahSubbobot = $query->result();

	}

	public function get_id($id)
	{	
		
		$query = $this->db->query('
			SELECT 
				"perspektifs"."perspektif", 
				"kategoris"."kategori",
				"programdetails"."no", 
				"programdetails"."indikator",
				"programdetails"."id_programtahun",
				"programdetails"."id_perspektif",
				"programdetails"."id_kategori",
				"programdetails"."id_satuan",
				"satuans"."satuan", 
				"programdetails"."target", 
				"programdetails"."keterangan", 
				"programdetails"."sub_bobot" 
			FROM "programdetails" 
			LEFT OUTER JOIN "kategoris" ON "programdetails"."id_kategori"="kategoris"."id_kategori" 
			LEFT OUTER JOIN "satuans" ON "programdetails"."id_satuan"="satuans"."id_satuan" 
			LEFT OUTER JOIN "perspektifs" ON "programdetails"."id_perspektif" = "perspektifs"."id_perspektif" 
			WHERE "id_programdetail" = \''.$id.'\'
		');
		
		
		//print($this->db->last_query());
		//print_r($query->row());
		//exit;
		return $query->row();
	}


	public function insert($data)
	{

		$this->db->insert('programdetails',$data);
	}
	
	
	public function update($id)
	{
		$data = array(
			'no'				=> $this->input->post('no'),
			'id_perspektif'		=> $this->input->post('id_perspektif'),
			'id_kategori' 		=> $this->input->post('id_kategori'),
			'indikator' 		=> $this->input->post('indikator'),
			'sub_bobot' 		=> $this->input->post('sub_bobot'),
			'id_satuan' 		=> $this->input->post('id_satuan'),
			'target' 			=> $this->input->post('target'),
			'keterangan' 		=> $this->input->post('keterangan'),
		);
		$this->db->where('id_programdetail', $id);
		$update = $this->db->update('programdetails', $data);
		return $this->db->affected_rows();
	}
	public function delete($id)
	{
		$this->db->where('id_programdetail', $id);
		$this->db->delete('programdetails');
	}
}

/*
		$this->db->select('perspektifs.perspektif, programdetails.no, programdetails.id_perspektif,programdetails.id_programdetail, kategoris.kategori, programdetails.sub_bobot, programdetails.indikator, satuans.satuan, programdetails.target, programdetails.keterangan' );
		
		
		$this->db->select('perspektifs.perspektif, programdetails.no, programdetails.id_programdetail, kategoris.kategori, programdetails.sub_bobot, programdetails.indikator, satuans.satuan, programdetails.target, programdetails.keterangan' );
		//, programtahuns.id_programtahun
		$this->db->from('programdetails');
		$this->db->join('kategoris','kategoris.id_kategori=programdetails.id_kategori');
		$this->db->join('satuans','satuans.id_satuan=programdetails.id_satuan');
		$this->db->join('perspektifs','perspektifs.id_perspektif=programdetails.id_perspektif');
		//$this->db->join('programtahuns','programtahuns.id_programtahun=programdetails.id_programdetail');
		$this->db->order_by('programdetails.id_programdetail','ASC');
		*/