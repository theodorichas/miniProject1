<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelgPermission extends Model
{
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
    }
    protected $table = 'group_permission';
    protected $allowedFields = ['group_id', 'view', 'edit', 'delete', 'menu_name', 'file_name'];
    protected $primaryKey = 'gp_id	';

    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $orderColumn = 'group_id', $orderDirection = 'asc')
    {
        $builder = $this->table('group_permission');

        if ($keyword) {
            $arr_keyword = explode(" ", $keyword);
            for ($i = 0; $i < count($arr_keyword); $i++) {
                $builder->groupStart();
                $builder->orLike('group_id', $arr_keyword[$i]);
                $builder->orLike('view', $arr_keyword[$i]);
                $builder->orLike('edit', $arr_keyword[$i]);
                $builder->orLike('delete', $arr_keyword[$i]);
                $builder->orLike('menu_name', $arr_keyword[$i]);
                $builder->orLike('file_name', $arr_keyword[$i]);
                $builder->groupEnd();
            }
        }

        if ($start != 0 or $length != 0) {
            $builder->limit((int)$length, (int)$start);
        }
        $builder->orderBy($orderColumn, $orderDirection);
        return $builder->get()->getResult();
    }
}
