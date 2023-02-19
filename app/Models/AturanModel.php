<?php

namespace App\Models;

use CodeIgniter\Model;

class AturanModel extends Model
{
    protected $table      = 'aturan';
    protected $primaryKey = 'kode_aturan';
    protected $returnType     = 'object';
    protected $useAutoIncrement = false;
    protected $useSoftDeletes = true;

    public $sikaps = [];

    protected $allowedFields = [
        'kode_aturan',
        'kode_permasalahan',
    ];


    public function hapus($kode_aturan)
    {
        $builder = $this->builder();
        $builder->where('kode_aturan', $kode_aturan)->delete();
    }

    public function last()
    {
        $builder = $this->builder();
        $query = $builder->orderBy('kode_aturan DESC')->limit(1)->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }
    
    public function findOne($kode_aturan)
    {
        $builder = $this->builder();
        $query = $builder->where('kode_aturan', $kode_aturan)
            ->join('permasalahan', 'aturan.kode_permasalahan = permasalahan.kode_permasalahan')
            ->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }

    public function findByPermasalahan($kode_permasalahan)
    {
        $builder = $this->builder();
        $query = $builder->where('kode_permasalahan', $kode_permasalahan)
            ->join('sikap', 'aturan.kode_sikap = sikap.kode_sikap')
            ->get();
        return $query->getResult();
    }

    public function loadAll()
    {
        $builder = $this->builder();
        $query = $builder
            ->join('permasalahan', 'aturan.kode_permasalahan = permasalahan.kode_permasalahan')
            ->orderBy('kode_aturan ASC')
            ->get();
        return $query->getResult();
    }
}
