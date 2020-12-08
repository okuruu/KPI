<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluasidetail_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get($id_evaluasi)
	{
		//get evaluasidetail
		$query = $this->db->query('
			SELECT 
					"evaluasidetails"."id_perspektif",
					"evaluasidetails"."id_kategori",
					"evaluasidetails"."id_satuan",
					"evaluasidetails"."id_evaluasidetail",
					"perspektifs"."perspektif",
					"kategoris"."kategori",
					"satuans"."satuan",
					"evaluasidetails"."no",
					"evaluasidetails"."indikator",
					"evaluasidetails"."sub_bobot",
					"evaluasidetails"."target",
					"evaluasidetails"."realisasi",
					"evaluasidetails"."kinerja_maks",
					"evaluasidetails"."tidak_tercapai",
					"evaluasidetails"."rtl",
					"evaluasidetails"."waktu_pj",
					"evaluasidetails"."nilai_prestasi",
					"evaluasidetails"."pencapaian_kinerja",
					"evaluasidetails"."keterangan"
			FROM "evaluasidetails"
			LEFT OUTER JOIN "perspektifs" ON "perspektifs"."id_perspektif"="evaluasidetails"."id_perspektif"
			LEFT OUTER JOIN "kategoris" ON "kategoris"."id_kategori" = "evaluasidetails"."id_kategori"
			LEFT OUTER JOIN "satuans" ON "satuans"."id_satuan" = "evaluasidetails"."id_satuan"
			WHERE "evaluasidetails"."id_evaluasi" = '.$id_evaluasi.'
						'); 
		//return $query->result();
		//get()
		$arrDataEvaluasi = $query->result();

		$query = $this->db->query('
			SELECT * FROM "perspektifs"
			');
		$arrDataPerspektif = $query->result();

		//get data kategori
		$query = $this->db->query('
			SELECT 
				ED."id_kategori",
				KT."kategori",
				ED."id_evaluasi",
				KT."urutan",
				ED."id_perspektif"
			FROM "evaluasidetails" ED
			LEFT OUTER JOIN "kategoris" KT ON KT."id_kategori" = ED."id_kategori"
			WHERE ED."id_evaluasi" = '.$id_evaluasi.'
			GROUP BY ED."id_perspektif", ED."id_kategori", KT."kategori", KT."urutan",  ED."id_evaluasi"
			ORDER BY KT."urutan" ASC
			');
		$arrDataKategoris = $query->result();
		
		//Get Data Unit
		
		//get perspektif
		$query = $this->db->query('
			SELECT * FROM "perspektifs"
			');
		$arrDataPerspektif = $query->result();

		//get unit, bulan, tahun
		$query = $this->db->query('
			select "evaluations"."id_evaluasi", "units"."nama_unit","evaluations"."tahun","bulans"."bulan" from "evaluations"
			join "units" on "units"."id_unit" = "evaluations"."id_unit"
			join "bulans" on "bulans"."id_bulan" = "evaluations"."id_bulan"
			where "id_evaluasi" = '.$id_evaluasi.'
        ');
			$arrProperties = $query->result();

			$ArrData = array(
							"Properties" 	=> $arrProperties,
							"Evaluasi"		=> $arrDataEvaluasi,
							"Kategori"		=> $arrDataKategoris,
							"Perspektif"	=> $arrDataPerspektif
						);
			/*
			echo "<pre>";			
			print_r($ArrData);
			echo "</pre>";
			exit;
			*/
			return $ArrData;



		//WHERE "evaluasidetails"."id_programdetail" = '.$id_programdetail.'

		//$this->db->select('evaluasidetails.id_evaluasidetail', 'units.id_unit','programtahuns.id_progamtahun','bulans.id_bulan','perspektifs.id_perspektif','kategoris.id_kategori','satuans.id_satuan','units.nama_unit','programtahuns.program_tahun','bulans.bulan','perspektifs.perspektif','kategoris.kategori', 'satuans.satuan', 'evaluasidetails.indikator','evaluasidetails.sub_bobot', 'evaluasidetails.target','evaluasidetails.realisasi','evaluasidetails.kinerja_maks','evaluasidetails.tidak_tercapai','evaluasidetails.rtl','evaluasidetails.waktu_pj','evaluasidetails.nilai_prestasi','evaluasidetails.pencapaian_kinerja','evaluasidetails.keterangan');
		//$this->db->from('evaluasidetails');
		//$this->db->join('units','units.id_unit=evaluasidetails.id_unit');
		//$this->db->join('programtahuns','programtahuns.id_programtahun=evaluasidetails.id_programtahun');
		//$this->db->join('bulans','bulans.id_bulan=evaluasidetails.id_bulan');
		//$this->db->join('perspektifs','perspektifs.id_perspektif=evaluasidetails.id_perspektif');
		//$this->db->join('kategoris','kategoris.id_kategori=evaluasidetails.id_kategori');
		//$this->db->join('satuans','satuans.id_satuan=evaluasidetails.id_satuan');
		//$this->db->order_by('evaluasidetails.id_evaluasidetail','DESC');
		//$query = $this->db->get();
	}

	public function get_jumlah($id_evaluasi)
	{
		$query = $this->db->query('
			SELECT "id_evaluasidetail", SUM("sub_bobot")
				FROM "evaluasidetails"
			WHERE "id_evaluasi" = '.$id_evaluasi.'
				GROUP BY "id_evaluasidetail"
			');
		$arrJumlahSubbobot = $query->result();

		//$this->db->select_sum('sub_bobot');
		//$this->db->from('evaluasidetails');
		//$query = $this->db->get();
		//return $query->result();
	}

	public function get_kali($id_evaluasi)
	{
		$query = $this->db->query('
			SELECT "id_evaluasidetail", "realisasi*target/100";
			FROM "evaluasidetails"
			WHERE "id_evaluasi" = '.$id_evaluasi.'
			GROUP BY "id_evaluasi"
			');
		$arrKaliRealisasi = $query->result();
	}
	public function get_perkalian($id_evaluasi)
	{
		$query = $this->db->query('
			SELECT "id_evaluasidetail","(pencapain_kinerja/100)*4"
			FROM "evaluasidetails"
			WHERE "id_evaluasi" = '.$id_evaluasi.'
			GROUP BY "id_evaluasidetail"
			');
		$arrPerkalian = $query->result();
	}
	public function get_id($id)
	{
		$query = $this->db->query('
			SELECT 
					"evaluasidetails"."id_perspektif",
					"evaluasidetails"."id_kategori",
					"evaluasidetails"."id_satuan",
					"perspektifs"."perspektif",
					"kategoris"."kategori",
					"satuans"."satuan",
					"evaluasidetails"."no",
					"evaluasidetails"."indikator",
					"evaluasidetails"."sub_bobot",
					"evaluasidetails"."target",
					"evaluasidetails"."realisasi",
					"evaluasidetails"."kinerja_maks",
					"evaluasidetails"."tidak_tercapai",
					"evaluasidetails"."rtl",
					"evaluasidetails"."waktu_pj",
					"evaluasidetails"."nilai_prestasi",
					"evaluasidetails"."pencapaian_kinerja",
					"evaluasidetails"."keterangan"
			FROM "evaluasidetails"
			LEFT OUTER JOIN "perspektifs" ON "evaluasidetails"."id_perspektif"="perspektifs"."id_perspektif"
			LEFT OUTER JOIN "kategoris" ON "evaluasidetails"."id_kategori" = "kategoris"."id_kategori"
			LEFT OUTER JOIN "satuans" ON "evaluasidetails"."id_satuan" = "satuans"."id_satuan"
			WHERE "id_evaluasidetail" = '.$id.' 
						');
			return $query->row();
			
			
			//WHERE "evaluasidetails"."id_programdetail" = '.$id_programdetail.'
		//$this->db->select('evaluasidetails.id_evaluasidetail, programtahuns.id_programtahun, bulans.id_bulan, perspektifs.is_perspektif, kategoris.id_kategori, satuans.id_satuan, units.nama_unit, programtahuns.program_tahun, bulans.bulan, perspektifs.perspektif, kategoris.kategori, satuans.satuan, evaluasidetails.indikator, evaluasidetails.sub_bobot, evaluasidetails.target, evaluasidetails.nilai_prestasi, evaluasidetails.pencapaian_kinerja, evaluasidetails.keterangan');
		//$this->db->from('evaluasidetails');
		//$this->db->where('id_evaluasidetail',$id);
		//$this->db->order_by('evaluasidetails.id_evaluasidetail','DESC');
		//$query = $this->db->get();
		//return $query->row();
	}

	public function insert($dati)
	{
		$dati = array(
			'no'					=> $this->input->post('no'),
			'id_perspektif'			=> $this->input->post('id_perspektif'),
			'id_kategori'			=> $this->input->post('id_kategori'),
			'indikator'				=> $this->input->post('indikator'),
			'sub_bobot' 			=> $this->input->post('sub_bobot'),
			'id_satuan' 			=> $this->input->post('id_satuan'),
			'target' 				=> $this->input->post('target'),
			'realisasi' 			=> $this->input->post('realisasi'),
			'keterangan' 			=> $this->input->post('keterangan'),
			'kinerja_maks'			=> $this->input->post('kinerja_maks'),
			'tidak_tercapai'		=> $this->input->post('tidak_tercapai'),
			'rtl'					=> $this->input->post('rtl'),
			'waktu_pj'				=> $this->input->post('waktu_pj'),
			'nilai_prestasi'		=> $this->input->post('nilai_prestasi'),
			'pencapaian_kinerja'	=> $this->input->post('pencapaian_kinerja'),
			'keterangan'			=> $this->input->post('keterangan'),
		);
		$this->db->insert('evaluasidetails',$dati);
	}
		public function update($id)
	{
		$data = array(
			
			'no'					=> $this->input->post('no'),
			'id_satuan' 			=> $this->input->post('id_satuan'),
			'target' 				=> $this->input->post('target'),
			'realisasi' 			=> $this->input->post('realisasi'),
			'pencapaian_kinerja'	=> $this->input->post('pencapaian_kinerja'),
			'kinerja_maks'			=> $this->input->post('kinerja_maks'),
			'nilai_prestasi'		=> $this->input->post('nilai_prestasi'),
			'tidak_tercapai'		=> $this->input->post('tidak_tercapai'),
			'rtl'					=> $this->input->post('rtl'),
			'waktu_pj'				=> $this->input->post('waktu_pj'),
			'keterangan'			=> $this->input->post('keterangan'),
		);
		$this->db->where('id_evaluasidetail', $id);
		$update = $this->db->update('evaluasidetails', $data);
		return $this->db->affected_rows();
	}
	
	public function delete($id)
	{
		$this->db->where('id_evaluasidetail', $id);
		$this->db->delete('evaluasidetails');
	}
}
