<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelGroup extends Model
{
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
    }
    protected $table = 'group';
    protected $allowedFields = ['group_code', 'group_name'];
    protected $primaryKey = 'id'; // Assuming 'id' is your primary key.

    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $orderColumn = 'group_code', $orderDirection = 'asc')
    {
        $builder = $this->table('group');

        if ($keyword) {
            $arr_keyword = explode(" ", $keyword);
            for ($i = 0; $i < count($arr_keyword); $i++) {
                $builder->groupStart();
                $builder->orLike('group_code', $arr_keyword[$i]);
                $builder->orLike('group_name', $arr_keyword[$i]);
                $builder->groupEnd();
            }
        }

        if ($start != 0 or $length != 0) {
            $builder->limit((int)$length, (int)$start);
        }
        $builder->orderBy($orderColumn, $orderDirection);
        return $builder->get()->getResult();
    }

    public function add_dataGroup($data)
    {
        $builder = $this->table('group');
        $builder->table('group')->insert($data);
    }

    public function update_dataGroup($id, $data)
    {
        $builder = $this->db->table('group');
        $builder->where('id', $id);
        $builder->update($data);
    }

    public function delete_dataGroup($id)
    {
        return $this->delete($id);
    }
}
