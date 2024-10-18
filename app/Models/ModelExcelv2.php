<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelExcelv2 extends Model
{
    protected $table = 'excelv2';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'employee_id',
        'nama',
        'grade',
        'periode',
        'gaji_pokok',
        'workdays',
        'wfo',
        'wfa',
        'ijin',
        'alpha',
        'total_transfer',
        'bca_source',
        'email',
    ];
    protected $useTimestamps = true;

    public function insertExcel($employeeData)
    {
        $builder = $this->table('excelv2');
        $builder->insert($employeeData);
    }

    public function deleteExcel($email)
    {
        $builder = $this->table('excelv2');
        $builder->where('email', $email);
        $builder->delete();
    }
}
