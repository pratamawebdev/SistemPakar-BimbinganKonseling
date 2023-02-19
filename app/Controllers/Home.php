<?php

namespace App\Controllers;

use \App\Models\SiswaModel;
use \App\Models\RiwayatModel;
use \App\Models\SikapModel;
use \App\Models\PermasalahanModel;
use \App\Models\AturanModel;

class Home extends BaseController
{
    private $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['session'] =  $this->session;
        $siswa = new SiswaModel();
        $data['siswa'] = $siswa->count();

        $riwayat = new RiwayatModel();
        $data['riwayat'] = $riwayat->count();

        $sikap = new SikapModel();
        $data['sikap'] = $sikap->count();

        $mslh = new PermasalahanModel();
        $data['permasalahan'] = $mslh->count();


        return view('home', $data);
    }
}
