<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user';
    protected $primaryKey = 'username';
    protected $returnType     = 'object';
    protected $useAutoIncrement = false;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['username', 'password', 'nama', 'role'];

    public function login($username, $password)
    {
        $builder = $this->builder();
        $query = $builder->where('username', $username)->where('password', md5($password))
            ->limit(1)->get();
        $data = $query->getResult();
        if (!empty($data)) {
            return $data[0];
        }
        return null;
    }

    public function hapus($username)
    {
        $builder = $this->builder();
        $builder->where('username', $username)->delete();
    }

    public function findOne($username)
    {
        $builder = $this->builder();
        $query = $builder->where('username', $username)->get();
        $data =  $query->getResult();
        if (empty($data)) return null;
        return $data[0];
    }

    public function loadAll()
    {
        $builder = $this->builder();
        $query = $builder->orderBy('role DESC')->get();
        return $query->getResult();
    }
    public function count()
    {
        $builder = $this->builder();
        return $builder->countAll();
    }
}
