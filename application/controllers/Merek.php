<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Merek extends CI_Controller
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
        $data['title'] = "Merek";
        $data['merek'] = $this->admin->get('merek');
        $this->template->load('templates/dashboard', 'merek/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_merek', 'Nama Merek', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Merek";
            $this->template->load('templates/dashboard', 'merek/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('merek', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('merek');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('merek/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Merek";
            $data['merek'] = $this->admin->get('merek', ['id_merek' => $id]);
            $this->template->load('templates/dashboard', 'merek/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('merek', 'id_merek', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('merek');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('merek/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('merek', 'id_merek', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('merek');
    }
}
