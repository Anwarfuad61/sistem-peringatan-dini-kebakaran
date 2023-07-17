<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kontrol extends CI_Controller
{
	public function index()
	{
		$data = [
			'title'   => 'Kontrol kipas',
			'page'    => 'kontrol',
			'kontrol' => $this->db->get('kontrol', 1)->row()
		];

		$this->load->view('index', $data);
	}

	public function update()
	{
		$id = $this->input->post('id');
		$kipas = $this->input->post('kipas');

		$data = [
			'kipas' => $kipas
		];

		$this->db->where('id', $id);
		$this->db->update('kontrol', $data);

		redirect('kontrol', 'refresh');
	}
}

/* End of file Kontrol.php */
