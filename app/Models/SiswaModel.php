<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table      = 'siswa';
    protected $primaryKey = 'nisn';
    protected $returnType     = 'object';
    protected $useAutoIncrement = false;
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'nisn',
        'nama_siswa',
        'kelas',
        'jenis_kelamin',
        'alamat',
        'no_hp_ortu',
    ];

    public $nisn_select;

    public function hapus($nisn)
    {
        $builder = $this->builder();
        $builder->where('nisn', $nisn)->delete();
    }

    public function findOne($nisn)
    {
        $builder = $this->builder();
        $query = $builder->where('nisn', $nisn)->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }

    public function last()
    {
        $builder = $this->builder();
        $query = $builder->orderBy('nisn DESC')->limit(1)->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }

    public function loadAll()
    {
        $builder = $this->builder();
        $query = $builder->orderBy('nisn ASC')->get();
        return $query->getResult();
    }
    public function count()
    {
        $builder = $this->builder();
        return $builder->countAll();
    }
}
