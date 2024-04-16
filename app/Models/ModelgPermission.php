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

    // public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $group_id)
    // {
    //     $builder = $this->table('menu');

    //     // Perform a join with the 'menu' table
    //     $builder->select('menu.*, gp.group_id, gp.view, gp.edit, gp.delete');
    //     $builder->join('group_permission gp', 'menu.menu_id = gp.menu_id', 'left');
    //     $builder->where('gp.group_id', $group_id);
    //     //display menu and file name


    //     if ($keyword) {
    //         $arr_keyword = explode(" ", $keyword);
    //         for ($i = 0; $i < count($arr_keyword); $i++) {
    //             $builder->groupStart();
    //             $builder->orLike('group_id', $arr_keyword[$i]);
    //             $builder->orLike('view', $arr_keyword[$i]);
    //             $builder->orLike('edit', $arr_keyword[$i]);
    //             $builder->orLike('delete', $arr_keyword[$i]);
    //             $builder->orLike('menu.menu_name', $arr_keyword[$i]); // Search in menu_name column
    //             $builder->orLike('menu.file_name', $arr_keyword[$i]); // Search in file_name column
    //             $builder->groupEnd();
    //         }
    //     }

    //     if ($start != 0 or $length != 0) {
    //         $builder->limit((int)$length, (int)$start);
    //     }
    //     return $builder->get()->getResult();
    // }
    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $group_id)
    {
        $sql = "SELECT menu.*, gp.group_id, gp.view, gp.edit, gp.delete
            FROM menu
            LEFT JOIN (SELECT * FROM group_permission WHERE group_id = $group_id) gp ON menu.menu_id = gp.menu_id";

        // Construct the SQL query
        if ($keyword) {
            $sql .= " AND (";
            $keywords = explode(" ", $keyword);
            foreach ($keywords as $index => $keyword) {
                if ($index > 0) {
                    $sql .= " OR ";
                }
                $sql .= "gp.group_id LIKE '%$keyword%' OR ";
                $sql .= "gp.view LIKE '%$keyword%' OR ";
                $sql .= "gp.edit LIKE '%$keyword%' OR ";
                $sql .= "gp.delete LIKE '%$keyword%' OR ";
                $sql .= "menu.menu_name LIKE '%$keyword%' OR ";
                $sql .= "menu.file_name LIKE '%$keyword%'";
            }
            $sql .= ")";
        }

        if ($length != 0) {
            $sql .= " LIMIT $length OFFSET $start";
        }

        // Execute the SQL query
        $query = $this->db->query($sql);


        // print_r($sql);
        // Return the result
        return $query->getResult();
    }

    // public function updateOrAddPermission($groupId, $menuId, $view, $edit, $delete)
    // {
    //     // Check if the permission already exists for the given group and menu
    //     $existingPermission = $this->where('group_id', $groupId)
    //         ->where('menu_id', $menuId)
    //         ->first();

    //     // If permission exists, update it; otherwise, insert a new permission
    //     if ($existingPermission) {
    //         $existingPermission->view = $view;
    //         $existingPermission->edit = $edit;
    //         $existingPermission->delete = $delete;
    //         $this->save($existingPermission);
    //     } else {
    //         $this->insert([
    //             'group_id' => $groupId,
    //             'menu_id' => $menuId,
    //             'view' => $view,
    //             'edit' => $edit,
    //             'delete' => $delete
    //         ]);
    //     }
    // }


    public function update_permission($group_id, $data)
    {
        $builder = $this->db->table('group_permission');
        $builder->where('group_permission', $group_id);
        $result = $builder->update($data);
        // $builder->update($data);
        if (!$result) {
            $error = $this->db->error();
            error_log('Database error in update_permission: ' . $error['message']);
        }
        return $result;
    }

    public function add_permission($data)
    {
        $builder = $this->table('group_permission');
        $result = $builder->insert($data);
        if (!$result) {
            $error = $this->db->error();
            error_log('Database error in add_permission: ' . $error['message']);
        }
        return $result;
    }
}
