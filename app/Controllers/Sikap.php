<?php

namespace App\Controllers;

use \App\Models\SikapModel;

use CodeIgniter\Files\File;

class Sikap extends BaseController
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
        $data['title'] = 'Data Sikap';
        $data['session'] =  $this->session;
        $model = new SikapModel();
        $data['data'] = $model->loadAll();
        return view('sikap/index', $data);
    }

    public function create()
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        $model = new sikapModel();
        if ($this->request->getMethod() === 'post') {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'kode_sikap' => 'required|is_unique[sikap.kode_sikap]',
                'nama_sikap' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();
            if ($isDataValid) {
                $post = (object)$this->request->getPost();
                $model->save([
                    "kode_sikap" => strtoupper($post->kode_sikap),
                    "nama_sikap" => $post->nama_sikap,
                ]);
                $this->session->setFlashdata('success', 'Berhasil menyimpan!');
                return redirect()->to('sikap/index');
            } else {
                $this->session->setFlashdata('error', $validation->listErrors());
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }
        $data['session'] =  $this->session;
        $data['title'] = 'Buat Data Sikap';
        
        $kode_sikap = '';
        if(($last = $model->last()) !== null) {
            $kode = preg_replace("/[^A-Za-z]/", "",$last->kode_sikap);
            $angka = preg_replace("/[^0-9]/", "",$last->kode_sikap);
            $angka += 1;
            if(strlen((string) $angka) == 1) $angka = '0'.$angka;
            $kode_sikap = $kode. $angka;
        }        
        $data['kode'] =  $kode_sikap;
        return view('sikap/create', $data);
    }

    public function update($kode_sikap)
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        $model = new SikapModel();
        $data['data'] = $model->findOne($kode_sikap);
        if ($this->request->getMethod() === 'post') {
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'kode_sikap' => 'required',
                'nama_sikap' => 'required',
            ]);
            $isDataValid = $validation->withRequest($this->request)->run();
            if ($isDataValid) {
                $post = (object)$this->request->getPost();
                $model->update($kode_sikap, [
                    "nama_sikap" => $post->nama_sikap
                ]);
                $this->session->setFlashdata('success', 'Berhasil menyimpan!');
                return redirect()->to('sikap/index');
            } else {
                $this->session->setFlashdata('error', $validation->listErrors());
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        }
        $data['session'] =  $this->session;
        $data['title'] = 'Ubah Data Sikap';
        return view('sikap/update', $data);
    }

    public function delete($kode_sikap)
    {
        if (empty($this->session->get('username'))) {
            return redirect()->to('user/login');
        }
        $model = new SikapModel();
        $model->hapus($kode_sikap);
        $this->session->setFlashdata('success', 'Berhasil menghapus!');
        return redirect()->to('sikap/index');
    } 
}
