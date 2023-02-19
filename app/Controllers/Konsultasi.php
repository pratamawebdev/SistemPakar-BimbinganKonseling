<?php

namespace App\Controllers;

use App\Models\SiswaModel;
use App\Models\RiwayatModel;
use App\Models\PilihanModel;
use App\Models\SikapModel;
use App\Models\PermasalahanModel;
use App\Models\AturanModel;
use App\Models\DetailAturanModel;

class Konsultasi extends BaseController
{
  private $session;

  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->session->start();
  }

  public function index()
  {
    if (empty($this->session->get("username"))) {
      return redirect()->to("user/login");
    }

    $model = new SiswaModel();
    if ($this->request->getMethod() === "post") {
      $post = (object) $this->request->getPost();
      if ($post->nisn_select == "") {
        $validation = \Config\Services::validation();
        $validation->setRules([
          "nisn" => "required|is_unique[siswa.nisn]",
          "nama_siswa" => "required",
          "kelas" => "required",
          "jenis_kelamin" => "required",
          "alamat" => "required",
          "no_hp_ortu" => "required",
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if ($isDataValid) {
          $model->save([
            "nisn" => strtoupper($post->nisn),
            "nama_siswa" => $post->nama_siswa,
            "kelas" => $post->kelas,
            "jenis_kelamin" => $post->jenis_kelamin,
            "alamat" => $post->alamat,
            "no_hp_ortu" => $post->no_hp_ortu,
          ]);
          $this->session->setFlashdata("success", "Berhasil menyimpan!");
          return redirect()->to("konsultasi/siswa/" . strtoupper($post->nisn));
        } else {
          $this->session->setFlashdata("error", $validation->listErrors());
          return redirect()
            ->back()
            ->withInput()
            ->with("errors", $validation->getErrors());
        }
      } else {
        return redirect()->to("konsultasi/siswa/" . $post->nisn_select);
      }
    }

    $data["title"] = "Konsultasi Siswa";
    $data["session"] = $this->session;
    $model = new SiswaModel();
    $data["data"] = $model->loadAll();
    $data["model"] = $model;
    return view("konsultasi/index", $data);
  }

  public function siswa($nisn)
  {
    if (empty($this->session->get("username"))) {
      return redirect()->to("user/login");
    }
    $riwayat = new RiwayatModel();
    $olds = $riwayat->loadOne($nisn, "DIMULAI");
    $id_riwayat = 0;
    if (empty($olds)) {
      $id_riwayat = $riwayat->insert([
        "nisn_siswa" => $nisn,
        "tanggal" => date("Y-m-d H:i:s"),
        "status" => "DIMULAI",
      ]);
    } else {
      $id_riwayat = $olds[0]->id_riwayat;
    }
    $model = new SiswaModel();
    $data["data"] = $model->findOne($nisn);
    $data["id_riwayat"] = $id_riwayat;
    $data["title"] = "Konsultasi Siswa ";
    $data["session"] = $this->session;

//    echo "<pre>";
//    print_r($data);
//    echo "</pre>";
    return view("konsultasi/siswa", $data);
  }

  public function hasil($id)
  {
    if (empty($this->session->get("username"))) {
      return redirect()->to("user/login");
    }
    $riwayat = new RiwayatModel();
    $aturan = new AturanModel();
    $detail = new DetailAturanModel();
    $aturans = $aturan->loadAll();

    $data_kaidah = [];
    foreach ($aturans as $d) {
      if (!isset($data_kaidah[$d->kode_permasalahan])) {
        $data_kaidah[$d->kode_permasalahan] = (object) [
          "kode_aturan" => $d->kode_aturan,
          "kode_permasalahan" => $d->kode_permasalahan,
          "nama_permasalahan" => $d->nama_permasalahan,
          "solusi" => $d->solusi,
          "sesuai" => 0,
          "nilai" => 0,
          "sikaps" => $detail->findAturan($d->kode_aturan),
        ];
      }
    }

    $pilihan = new PilihanModel();
    $pilihans = $pilihan->findByRiwayat($id);
    foreach ($data_kaidah as $k1 => $k) {
      foreach ($k->sikaps as $k2 => $s) {
        foreach ($pilihans as $p) {
          if ($s->kode_sikap == $p->kode_sikap) {
            $data_kaidah[$k1]->sikaps[$k2]->pilihan = $p->pilihan;
            if ($p->pilihan == 1) {
              $data_kaidah[$k1]->sesuai += 1;
            }
          }
        }
      }
    }

    foreach ($data_kaidah as $k1 => $k) {
      $data_kaidah[$k1]->nilai =
        ($data_kaidah[$k1]->sesuai / sizeof($data_kaidah[$k1]->sikaps)) * 100;
    }
    usort($data_kaidah, function ($a, $b) {
      return $b->nilai - $a->nilai;
    });
    $hasil_obj = (object) [
      "hasil" => $data_kaidah,
      "pilihan" => $pilihans,
    ];
    $hasil = null;

    $pil_iya = 0;
    foreach ($pilihans as $p) {
      if ($p->pilihan == 1) {
        $pil_iya += 1;
      }
    }

    if ($data_kaidah[0]->nilai == 100 && $data_kaidah[0]->sesuai == $pil_iya) {
      $hasil = $data_kaidah[0];
    }
    $riwayat->update($id, [
      "status" => "SELESAI",
      "kode_hasil" => $hasil == null ? null : $hasil->kode_permasalahan,
      "hasil" => $hasil == null ? "Hasil Tidak Ditemukan" : $hasil->nama_permasalahan,
      "solusi" => $hasil == null ? null : $hasil->solusi,
      "perhitungan" => json_encode($hasil_obj),
      "status" => "SELESAI",
    ]);
    $data["id_riwayat"] = $id;
    $data["data"] = $hasil_obj;
    $data["hasil"] = $riwayat->findOne($id);
    $data["pilihans"] = $pilihans;
    $data["title"] = "Hasil Konsultasi Siswa ";
    $data["session"] = $this->session;
    return view("konsultasi/hasil", $data);
  }

  public function pertanyaan()
  {
    if (empty($this->session->get("username"))) {
      return redirect()->to("user/login");
    }

    $model = new SiswaModel();
    if ($this->request->getMethod() === "post") {
      $post = (object) $this->request->getPost();
      $riwayat = new RiwayatModel();
      $pilihan = new PilihanModel();
      $sikap = new SikapModel();
      $total=$sikap->count();
      if (($model = $riwayat->findOne($post->id)) !== null) {
        $last = $pilihan->last($post->id);
        $sikaps = $sikap->loadAll();
        $next = false;
        foreach ($sikaps as $skp) {
          if ($last == null || $next) {
            return json_encode([
              "success" => true,
              "sikap" => $skp,
	            "total" => $total,
              "last" => $last,
            ]);
          }
          if ($skp->kode_sikap == $last->kode_sikap) {
            $next = true;
          }
        }
        return json_encode([
          "success" => true,
          "sikap" => null,
        ]);
      }
    }
    return json_encode([
      "success" => false,
    ]);
  }

  public function jawab()
  {
    if (empty($this->session->get("username"))) {
      return redirect()->to("user/login");
    }

    $model = new SiswaModel();
    if ($this->request->getMethod() === "post") {
      $post = (object) $this->request->getPost();
      $riwayat = new RiwayatModel();
      $pilihan = new PilihanModel();
      $sikap = new SikapModel();
      if (($model = $riwayat->findOne($post->id)) !== null) {
        $old = $pilihan->findByRiwayatAndSikap($post->id, $post->kode_sikap);
        if ($old == null) {
          $id_pilihan = $pilihan->insert([
            "id_riwayat" => $post->id,
            "kode_sikap" => $post->kode_sikap,
            "pilihan" => $post->jawaban,
            "created_at" => date("Y-m-d H:i:s"),
          ]);
        }
        return json_encode([
          "success" => true,
        ]);
      }
    }
    return json_encode([
      "success" => false,
    ]);
  }
}
