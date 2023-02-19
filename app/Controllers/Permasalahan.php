<?php

namespace App\Controllers;

use \App\Models\PermasalahanModel;

use CodeIgniter\Files\File;

class Permasalahan extends BaseController
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
        $data['title'] = 'Data Permasalahan';
        $data['session'] =  $this->session;
        $model = new PermasalahanModel();
        $data['data'] = $model->loadAll();        
        return view('permasalahan/index', $data);
    }

    public function create()
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        $model = new PermasalahanModel();
        if ($this->request->getMethod() === 'post') {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'kode_permasalahan' => 'required|is_unique[permasalahan.kode_permasalahan]',
                'nama_permasalahan' => 'required',
                'solusi' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();
            if ($isDataValid) {
                $post = (object)$this->request->getPost();
                $model->save([
                    "kode_permasalahan" => strtoupper($post->kode_permasalahan),
                    "nama_permasalahan" => $post->nama_permasalahan,
                    "solusi" => $post->solusi,
                ]);
                $this->session->setFlashdata('success', 'Berhasil menyimpan!');
                return redirect()->to('permasalahan/index');
            } else {
                $this->session->setFlashdata('error', $validation->listErrors());
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }
        $data['session'] =  $this->session;
        $data['title'] = 'Buat Data Permasalahan';
        
        $kode_permasalahan = '';
        if(($last = $model->last()) !== null) {
            $kode = preg_replace("/[^A-Za-z]/", "",$last->kode_permasalahan);
            $angka = preg_replace("/[^0-9]/", "",$last->kode_permasalahan);
            $angka += 1;
            if(strlen((string) $angka) == 1) $angka = '0'.$angka;
            $kode_permasalahan = $kode. $angka;
        }        
        $data['kode'] =  $kode_permasalahan;

        return view('permasalahan/create', $data);
    }

    public function update($kode_permasalahan)
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        $model = new PermasalahanModel();
        $data['data'] = $model->findOne($kode_permasalahan);
        if ($this->request->getMethod() === 'post') {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'kode_permasalahan' => 'required',
                'nama_permasalahan' => 'required',
                'solusi' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();
            if ($isDataValid) {
                $post = (object)$this->request->getPost();
                $model = new PermasalahanModel();
                $model->update($kode_permasalahan, [
                    "nama_permasalahan" => $post->nama_permasalahan,
                    "solusi" => $post->solusi,
                ]);
                $this->session->setFlashdata('success', 'Berhasil menyimpan!');
                return redirect()->to('permasalahan/index');
            } else {
                $this->session->setFlashdata('error', $validation->listErrors());
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }
        $data['session'] =  $this->session;
        $data['title'] = 'Ubah Data Permasalahan';
        return view('permasalahan/update', $data);
    }

    public function delete($kode_permasalahan)
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        $model = new PermasalahanModel();
        $model->hapus($kode_permasalahan);
        $this->session->setFlashdata('success', 'Berhasil menghapus!');
        return redirect()->to('permasalahan/index');
    }
}
