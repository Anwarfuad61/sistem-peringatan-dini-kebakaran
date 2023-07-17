<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function simpan()
    {
        // Mendapatkan data dari request
        $statusGerakan = $this->input->get('statusGerakan');
        $statusKebakaran = $this->input->get('statusKebakaran');

        // Memastikan data tidak kosong
        if ($statusGerakan !== '' && $statusKebakaran !== '') {
            // Menyiapkan data untuk disimpan ke database
            $data = [
                'statusGerakan' => $statusGerakan,
                'statusKebakaran' => $statusKebakaran
            ];

            // Menyimpan data ke database
            $insert = $this->db->insert('data', $data);

            if ($insert) {
                $result = 'Data berhasil disimpan';
            } else {
                $result = 'Gagal menyimpan data';
            }
        } else {
            $result = 'Data tidak boleh kosong';
        }

        // Mengambil data terakhir dari tabel kontrol
        $kontrol = $this->db->get('kontrol', 1)->row();

        // Mengembalikan respons dalam format JSON
        $response = [
            'status' => $result,
            'kipas' => $kontrol->kipas
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}

/* End of file Data.php */
