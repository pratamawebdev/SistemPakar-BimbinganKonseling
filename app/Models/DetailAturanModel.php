<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailAturanModel extends Model
{
    protected $table      = 'detail_aturan';
    protected $primaryKey = 'id_detail';
    protected $returnType     = 'object';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes = true;

    public $pilihan;
    protected $allowedFields = [
        'id_detail',
        'kode_aturan',
        'kode_sikap',
    ];


    public function hapus($id_detail)
    {
        $builder = $this->builder();
        $builder->where('id_detail', $id_detail)->delete();
    }

    public function findAturan($kode_aturan)
    {
        $builder = $this->builder();
        $query = $builder->where('kode_aturan', $kode_aturan)
            ->join('sikap', 'detail_aturan.kode_sikap = sikap.kode_sikap')->get();
        $data =  $query->getResult();
        return $data;
    }

}
