<?php

namespace App\Controllers;

use App\Models\AturanModel;
use App\Models\DetailAturanModel;
use App\Models\SikapModel;
use App\Models\PermasalahanModel;

use CodeIgniter\Files\File;

class Aturan extends BaseController
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
    $data["title"] = "Data Basis aturan";
    $data["session"] = $this->session;
    $model = new AturanModel();
    $detail = new DetailAturanModel();
    $data_aturan = $model->loadAll();

    foreach ($data_aturan as $k => $v) {
      $data_aturan[$k]->sikaps = $detail->findAturan($v->kode_aturan);
    }
    $data["data"] = $data_aturan;

    return view("aturan/index", $data);
  }

  public function create()
  {
    if (empty($this->session->get("username"))) {
      return redirect()->to("user/login");
    }
    $model = new AturanModel();
    if ($this->request->getMethod() === "post") {
      $validation = \Config\Services::validation();
      $validation->setRules([
        "kode_aturan" => "required|is_unique[aturan.kode_aturan]",
        "kode_permasalahan" => "required",
        "sikaps" => "required",
      ]);
      $isDataValid = $validation->withRequest($this->request)->run();
      if ($isDataValid) {
        $post = (object) $this->request->getPost();
        if (sizeof($post->sikaps) > 0) {
          $kode_aturan = strtoupper($post->kode_aturan);
          $model->save([
            "kode_aturan" => $kode_aturan,
            "kode_permasalahan" => $post->kode_permasalahan,
          ]);
          $detail = new DetailAturanModel();
          foreach ($post->sikaps as $sikap) {
            $detail->save([
              "kode_aturan" => $kode_aturan,
              "kode_sikap" => $sikap,
            ]);
          }
          $this->session->setFlashdata("success", "Berhasil menyimpan!");
          return redirect()->to("aturan/index");
        } else {
          $this->session->setFlashdata("error", "Sikap harus diisi!");
          return redirect()
            ->back()
            ->withInput()
            ->with("errors", $validation->getErrors());
        }
      } else {
        $this->session->setFlashdata("error", $validation->listErrors());
        return redirect()
          ->back()
          ->withInput()
          ->with("errors", $validation->getErrors());
      }
    }
    $data["session"] = $this->session;
    $data["title"] = "Buat Basis Aturan";
    $permasalahan = new PermasalahanModel();
    $sikap = new SikapModel();
    $data["permasalahan"] = $permasalahan->loadAll();
    $data["sikap"] = $sikap->loadAll();

    return view("aturan/create", $data);
  }

  public function update($id_aturan)
  {
    if (empty($this->session->get("username"))) {
      return redirect()->to("user/login");
    }
    $model = new AturanModel();
    $data["data"] = $model->findOne($id_aturan);
    if ($this->request->getMethod() === "post") {
      $validation = \Config\Services::validation();
      $validation->setRules([
        "kode_aturan" => "required",
        "kode_permasalahan" => "required",
        "sikaps" => "required",
      ]);
      $isDataValid = $validation->withRequest($this->request)->run();
      if ($isDataValid) {
        $post = (object) $this->request->getPost();

        if (sizeof($post->sikaps) > 0) {
          $kode_aturan = strtoupper($post->kode_aturan);
          $model->update($id_aturan, [
            "kode_aturan" => $post->kode_aturan,
            "kode_permasalahan" => $post->kode_permasalahan,
          ]);
          $detail = new DetailAturanModel();
          $old_sikap = $detail->findAturan($id_aturan);
          foreach ($post->sikaps as $sikap) {
            $f = false;
            foreach ($old_sikap as $i => $old) {
              if ($old->kode_sikap == $sikap) {
                $f = true;
                unset($old_sikap[$i]);
                break;
              }
            }
            if (!$f) {
              $detail->save([
                "kode_aturan" => $kode_aturan,
                "kode_sikap" => $sikap,
              ]);
            }
          }
          foreach($old_sikap as $old) {
            $detail->hapus($old->id_detail);
          }
          $this->session->setFlashdata("success", "Berhasil menyimpan!");
          return redirect()->to("aturan/index");
        } else {
          $this->session->setFlashdata("error", "Sikap harus diisi!");
          return redirect()
            ->back()
            ->withInput()
            ->with("errors", $validation->getErrors());
        }

        $this->session->setFlashdata("success", "Berhasil menyimpan!");
        return redirect()->to("aturan/index");
      } else {
        $this->session->setFlashdata("error", $validation->listErrors());
        return redirect()
          ->back()
          ->withInput()
          ->with("errors", $validation->getErrors());
      }
    }
    $data["session"] = $this->session;
    $data["title"] = "Ubah Data Aturan";
    $detail = new DetailAturanModel();
    foreach ($detail->findAturan($id_aturan) as $d) {
      $data["data"]->sikaps[] = $d->kode_sikap;
    }
    $permasalahan = new PermasalahanModel();
    $sikap = new SikapModel();
    $data["permasalahan"] = $permasalahan->loadAll();
    $data["sikap"] = $sikap->loadAll();
    return view("aturan/update", $data);
  }

  public function delete($id_aturan)
  {
    if (empty($this->session->get("username"))) {
      return redirect()->to("user/login");
    }
    $model = new AturanModel();
    $model->hapus($id_aturan);
    $this->session->setFlashdata("success", "Berhasil menghapus!");
    return redirect()->to("aturan/index");
  }
}
