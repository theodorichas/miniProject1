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


    public function update_permission($group_id, $data)
    {
        $builder = $this->db->table('group_permission');
        $builder->where('group_id', $group_id);
        $result = $builder->update($data);

        if ($result) {
            return true; // Update successful
        } else {
            error_log('Error updating permissions for group ID: ' . $group_id);
            return false; // Update failed
        }
    }

    public function add_permission($newArr, $group_id)
    {
        // Add the group_id to the data array
        $data['group_id'] = $group_id;

        // Insert the data into the database
        $builder = $this->db->table('group_permission');
        $result = $builder->insert($data);

        // Return the result of the insertion operation
        return $result;
    }

    public function remove_permission($group_id)
    {
        $builder = $this->where('group_id', $group_id)->delete();
        return $builder;
    }
}
