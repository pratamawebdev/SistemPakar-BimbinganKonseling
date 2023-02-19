<?php

namespace App\Models;

use CodeIgniter\Model;

class SikapModel extends Model
{
    protected $table      = 'sikap';
    protected $primaryKey = 'kode_sikap';
    protected $returnType     = 'object';
    protected $useAutoIncrement = false;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'kode_sikap',
        'nama_sikap',
    ];

    public function hapus($kode_sikap)
    {
        $builder = $this->builder();
        $builder->where('kode_sikap', $kode_sikap)->delete();
    }

    public function findOne($kode_sikap)
    {
        $builder = $this->builder();
        $query = $builder->where('kode_sikap', $kode_sikap)->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }

    public function last()
    {
        $builder = $this->builder();
        $query = $builder->orderBy('kode_sikap DESC')->limit(1)->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }

    public function loadAll()
    {
        $builder = $this->builder();
        $query = $builder->orderBy('kode_sikap ASC')->get();
        return $query->getResult();
    }
    public function count()
    {
        $builder = $this->builder();
        return $builder->countAll();
    }
}
