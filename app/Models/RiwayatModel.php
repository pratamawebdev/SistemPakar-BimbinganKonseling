<?php

namespace App\Models;

use CodeIgniter\Model;

class RiwayatModel extends Model
{
  protected $table = "riwayat";
  protected $primaryKey = "id_riwayat";
  protected $returnType = "object";
  protected $useAutoIncrement = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = [
    "nisn_siswa",
    "tanggal",
    "kode_hasil",
    "hasil",
    "solusi",
    "perhitungan",
    "status",
  ];

  public function hapus($id_riwayat)
  {
    $builder = $this->builder();
    $builder->where("id_riwayat", $id_riwayat)->delete();
  }

  public function findOne($id_riwayat)
  {
    $builder = $this->builder();
    $query = $builder->where("id_riwayat", $id_riwayat)->get();
    $data = $query->getResult();
    if (empty($data)) {
      return null;
    }
    return $data[0];
  }

  public function loadAll()
  {
    $builder = $this->builder();
    $query = $builder
      ->join(
        "permasalahan",
        "riwayat.kode_hasil = permasalahan.kode_permasalahan", "left"
      )
      ->join("siswa", "riwayat.nisn_siswa = siswa.nisn")
      ->orderBy("tanggal DESC")
      ->get();
    return $query->getResult();
  }

  public function loadBySiswa($nisn, $status)
  {
    $builder = $this->builder();
    $query = $builder
      ->where("nisn_siswa", $nisn)
      ->where("status", $status)
      ->join(
        "permasalahan",
        "riwayat.kode_hasil = permasalahan.kode_permasalahan"
      )
      ->join("siswa", "riwayat.nisn_siswa = siswa.nisn")
      ->orderBy("tanggal DESC")
      ->get();
    return $query->getResult();
  }
  
  public function loadOne($nisn, $status)
  {
    $builder = $this->builder();
    $query = $builder
      ->where("nisn_siswa", $nisn)
      ->where("status", $status)
      ->orderBy("tanggal DESC")
      ->get();
    return $query->getResult();
  }

  public function count()
  {
    $builder = $this->builder();
    return $builder->countAll();
  }
}
