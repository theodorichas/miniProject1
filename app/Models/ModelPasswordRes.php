<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPasswordRes extends Model
{

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
    }
    protected $table = 'password_resets';
    protected $allowedFields = ['email', 'token', 'created_at'];
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $returnType = 'array';

    public function insertData($data)
    {
        $builder = $this->db->table('password_resets');
        $builder->insert($data);
    }
    public function tokenRequest($token)
    {
        $builder = $this->db->table('password_resets');
        $builder->select('token, created_at');
        $builder->where('token', $token);
        $resetRequest = $builder->get()->getRowArray();
        return $resetRequest;
    }
}
