<?php

namespace App\Models;

use CodeIgniter\Model;

class PilihanModel extends Model
{
  protected $table = "pilihan";
  protected $primaryKey = "id_pilihan";
  protected $returnType = "object";
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = [
    "id_riwayat",
    "kode_sikap",
    "pilihan",
    "created_at",
  ];

  public function hapus($id_pilihan)
  {
    $builder = $this->builder();
    $builder->where("id_pilihan", $id_pilihan)->delete();
  }

  public function findOne($id_pilihan)
  {
    $builder = $this->builder();
    $query = $builder->where("id_pilihan", $id_pilihan)->get();
    $data = $query->getResult();
    if (empty($data)) {
      return null;
    }
    return $data[0];
  }

  public function last($id_riwayat)
  {
    $builder = $this->builder();
    $query = $builder
      ->where("id_riwayat", $id_riwayat)
      ->orderBy("created_at DESC")
      ->get();
    $data = $query->getResult();
    if (empty($data)) {
      return null;
    }
    return $data[0];
  }

  public function findByRiwayatAndSikap($id_riwayat, $kode_sikap)
  {
    $builder = $this->builder();
    $query = $builder
      ->where("id_riwayat", $id_riwayat)
      ->where("kode_sikap", $kode_sikap)
      ->get();
    $data = $query->getResult();
    if (empty($data)) {
      return null;
    }
    return $data[0];
  }

  public function findByRiwayat($id_riwayat)
  {
    $builder = $this->builder();
    $query = $builder
      ->join("sikap", "pilihan.kode_sikap = sikap.kode_sikap")
      ->where("id_riwayat", $id_riwayat)
      ->get();
    $data = $query->getResult();
    return $data;
  }

  public function loadAll()
  {
    $builder = $this->builder();
    $query = $builder
      ->join("sikap", "pilihan.kode_sikap = sikap.kode_sikap")
      ->orderBy("kode_sikap ASC")
      ->get();
    return $query->getResult();
  }
}
