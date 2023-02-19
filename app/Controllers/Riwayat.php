<?php

namespace App\Controllers;

use \App\Models\RiwayatModel;

class Riwayat extends BaseController
{
    private $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }


    public function index()
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        $data['title'] = 'Data Riwayat';
        $data['session'] =  $this->session;
        $model = new RiwayatModel();
        $data['data'] = $model->loadAll();
        return view('riwayat/index', $data);
    }

    public function delete($id)
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        $model = new RiwayatModel();
        $model->hapus($id);
        $this->session->setFlashdata('success', 'Berhasil menghapus!');
        return redirect()->to('riwayat/index');
    }
}
