<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Cabang";
        $data['cabang'] = $this->admin->get('cabang');
        $this->template->load('templates/dashboard', 'cabang/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_cabang', 'Nama Cabang', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Cabang";
            $this->template->load('templates/dashboard', 'cabang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('cabang', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('cabang');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('cabang/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Cabang";
            $data['cabang'] = $this->admin->get('cabang', ['id_cabang' => $id]);
            $this->template->load('templates/dashboard', 'cabang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('cabang', 'id_cabang', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('cabang');
            } else {
                set_pesan('data gagal diedit.');
                redirect('cabang/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('cabang', 'id_cabang', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('cabang');
    }
}
