<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMenu extends Model
{
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
    }
    protected $table = 'menu';
    protected $allowedFields = ['menu_name', 'page_name', 'file_name', 'parent_menu', 'icon', 'note', 'order_no', 'visible'];
    protected $primaryKey = 'menu_id'; // Assuming 'id' is your primary key., 

    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $orderColumn = 'menu_name', $orderDirection = 'asc')
    {
        $builder = $this->table('menu');

        if ($keyword) {
            $arr_keyword = explode(" ", $keyword);
            for ($i = 0; $i < count($arr_keyword); $i++) {
                $builder->groupStart();
                $builder->orLike('menu_name', $arr_keyword[$i]);
                $builder->orLike('page_name', $arr_keyword[$i]);
                $builder->orLike('file_name', $arr_keyword[$i]);
                $builder->orLike('parent_menu', $arr_keyword[$i]);
                $builder->orLike('icon', $arr_keyword[$i]);
                $builder->orLike('note', $arr_keyword[$i]);
                $builder->orLike('order_no', $arr_keyword[$i]);
                $builder->orLike('visible', $arr_keyword[$i]);
                $builder->groupEnd();
            }
        }

        if ($start != 0 or $length != 0) {
            $builder->limit((int)$length, (int)$start);
        }
        $builder->orderBy($orderColumn, $orderDirection);
        return $builder->get()->getResult();
    }

    public function add_dataMenu($data)
    {
        $builder = $this->table('menu');
        $builder->table('menu')->insert($data);
    }

    public function update_dataMenu($menu_id, $data)
    {
        $builder = $this->table('menu');
        $builder->where('menu_id', $menu_id);
        $builder->update($data);
        var_dump($data);
    }

    public function delete_dataMenu($menu_id)
    {
        return $this->delete($menu_id);
    }
}