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
        $builder = $this->db->table('menu');
        $builder->where('menu_id', $menu_id);
        // print_r($menu_id);
        // die();
        $builder->update($data);
    }

    public function delete_dataMenu($menu_id)
    {
        return $this->delete($menu_id);
    }

    public function getMenuNames()
    {
        $builder = $this->db->table('menu');
        $builder->select('*');
        $builder->orderBy('order_no', 'asc');
        $query = $builder->get();
        return $query->getResult();
    }

    public function getMenuByMenuId($menuId)
    {
        $query = $this->db->table('menu')->where('menu_id', $menuId)->get();
        return $query->getFirstRow();
    }

    public function getMenuIdbyURI($fileName)
    {
        $builder = $this->db->table('menu');
        $builder->select('menu_id');
        $builder->where('file_name', $fileName);
        $result = $builder->get()->getFirstRow();

        // Ensure $result is an object and has the property 'menu_id'
        return $result ? $result->menu_id : null;
    }

    public function getMenuPageName($menuId)
    {
        $builder = $this->db->table('menu');
        $builder->select('page_name');
        $builder->where('menu_id', $menuId);
        $result = $builder->get()->getFirstRow();

        // Ensure $result is an object and has the property 'page_name'
        if ($result && isset($result->page_name)) {
            return $result->page_name;
        }
        return null;
    }
}
