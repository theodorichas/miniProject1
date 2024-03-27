<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPermission extends Model
{
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
    }
    protected $table = 'permission';
    protected $allowedFields = ['permi_name', 'permi_desc'];
    protected $primaryKey = 'permi_id'; // Assuming 'id' is your primary key.

    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $orderColumn = 'permi_name', $orderDirection = 'asc')
    {
        $builder = $this->table('permission');

        if ($keyword) {
            $arr_keyword = explode(" ", $keyword);
            for ($i = 0; $i < count($arr_keyword); $i++) {
                $builder->groupStart();
                $builder->orLike('permi_name', $arr_keyword[$i]);
                $builder->orLike('permi_desc', $arr_keyword[$i]);
                $builder->groupEnd();
            }
        }

        if ($start != 0 or $length != 0) {
            $builder->limit((int)$length, (int)$start);
        }
        $builder->orderBy($orderColumn, $orderDirection);
        return $builder->get()->getResult();
    }

    public function add_dataPermi($data)
    {
        $builder = $this->table('permission');
        $builder->table('permission')->insert($data);
    }
    public function update_dataPermi($permi_id, $data)
    {
        $builder = $this->db->table('permission');
        $builder->where('permi_id', $permi_id);
        $builder->update($data);
    }
    public function delete_dataPermi($permi_id)
    {
        return $this->delete($permi_id);
    }
}
