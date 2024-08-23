<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelExcel extends Model
{
    protected $table = 'excel';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nip', 'tgl_lahir', 'alamat', 'email', 'no_telp', 'salary'];
    protected $useTimestamps = true;

    public function insertExcel($employeeData)
    {
        $builder = $this->table('excel');
        $builder->insert($employeeData);
    }

    public function deleteExcel($email)
    {
        $builder = $this->table('excel');
        $builder->where('email', $email);
        $builder->delete();
    }
}
