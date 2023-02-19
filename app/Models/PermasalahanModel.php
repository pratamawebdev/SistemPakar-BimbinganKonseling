<?php

namespace App\Models;

use CodeIgniter\Model;

class PermasalahanModel extends Model
{
    protected $table      = 'permasalahan';
    protected $primaryKey = 'kode_permasalahan';
    protected $returnType     = 'object';
    protected $useAutoIncrement = false;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'kode_permasalahan',
        'nama_permasalahan',
        'solusi',
    ];

    public $aturans = [];

    public function last()
    {
        $builder = $this->builder();
        $query = $builder->orderBy('kode_permasalahan DESC')->limit(1)->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }

    public function hapus($kode_permasalahan)
    {
        $builder = $this->builder();
        $builder->where('kode_permasalahan', $kode_permasalahan)->delete();
    }

    public function findOne($kode_permasalahan)
    {
        $builder = $this->builder();
        $query = $builder->where('kode_permasalahan', $kode_permasalahan)->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }

    public function loadAll()
    {
        $builder = $this->builder();
        $query = $builder->orderBy('kode_permasalahan ASC')->get();
        return $query->getResult();
    }

    public function count()
    {
        $builder = $this->builder();
        return $builder->countAll();
    }
}
