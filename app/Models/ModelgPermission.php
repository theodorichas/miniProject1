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
    protected $allowedFields = ['group_id', 'view', 'edit', 'delete', 'menu_id'];
    protected $primaryKey = 'gp_id';

    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $group_id)
    {
        $builder = $this->table('group_permission');

        // Perform a join with the 'menu' table
        $builder->select('group_permission.*, menu.menu_name, menu.file_name');
        $builder->join('menu', 'menu.menu_id = group_permission.menu_id');
        $builder->where('group_id', $group_id);


        if ($keyword) {
            $arr_keyword = explode(" ", $keyword);
            for ($i = 0; $i < count($arr_keyword); $i++) {
                $builder->groupStart();
                $builder->orLike('group_id', $arr_keyword[$i]);
                $builder->orLike('view', $arr_keyword[$i]);
                $builder->orLike('edit', $arr_keyword[$i]);
                $builder->orLike('delete', $arr_keyword[$i]);
                $builder->orLike('menu.menu_name', $arr_keyword[$i]); // Search in menu_name column
                $builder->orLike('menu.file_name', $arr_keyword[$i]); // Search in file_name column
                $builder->groupEnd();
            }
        }

        if ($start != 0 or $length != 0) {
            $builder->limit((int)$length, (int)$start);
        }
        return $builder->get()->getResult();
    }
}
