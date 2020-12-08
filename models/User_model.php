<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {


	var $table = 'users';

public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

public function get() 
{
				$this->db->select('*');
				$this->db->from('users');
				$this->db->order_by('users.id_user', 'ASC');
				$query = $this->db->get();
				return $query->result();
} 

public function get_id($id) {
	$this->db->from('users');
		$this->db->where('id_user',$id);
		$query = $this->db->get();
		return $query->row();
}


	public function Registrasi($data)
	{
		$this->db->insert('users', $data);
	}


	public function insert()
	{
		//$set = array(
	 	//'nama' => $this->$input->post('nama'),
	 	//'alamat' => $this->input->post('alamat'),
	 	//'email' => $this->input->post('email'),
	 	//'username' => $this->input->post('username'),
	 	//'password' => md5($this->input->post('password')),
		//);
		// $this->curl->simple_post($this->webdata->api_rest.'/Karyawan', $set, array(CURLOPT_BUFFERSIZE => 10));
	}
	public function update($id)
	{
		$data = array(
			'id_user'	=> $id,
			'nama' 		=> $this->input->post('nama'),
			'alamat'	=> $this->input->post('alamat'),
			'email'		=> $this->input->post('email'),
			'username' 	=> $this->input->post('username'),
			'password' 	=> $this->input->post('password'),
		);
		$this->db->where('id_user', $id);
		$update = $this->db->update('users', $data);
		return $this->db->affected_rows();

	}
	public function delete($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('users');
	}
}
