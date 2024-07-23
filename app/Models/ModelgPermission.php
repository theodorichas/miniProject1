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


    public function add_permission($newArr)
    {
        // Extract the group_id from the first row of the new data (assuming all rows have the same group_id)
        $group_id = $newArr[0]['group_id'];

        // Create a builder instance for the group_permission table
        $builder = $this->db->table('group_permission');

        // Check if there are existing records with the same group_id
        $existingRecords = $builder->where('group_id', $group_id)->get()->getResultArray();

        if (!empty($existingRecords)) {
            // Delete existing records with the same group_id
            $builder->where('group_id', $group_id)->delete();
        }

        // Insert the new data into the database
        $insertedRows = 0;

        foreach ($newArr as $row) {
            // Add the group_id to the data array
            $row['group_id'] = $group_id; // No need for assignment again, already set

            // Insert the data into the database
            $result = $builder->insert($row);

            // Check if insertion was successful
            if ($result) {
                $insertedRows++;
            }
        }

        // Return the number of rows successfully inserted
        return $insertedRows;
    }

    public function get_permission($group_id)
    {
        $builder = $this->db->table('group_permission');
        $builder->select('*');
        $builder->where('group_id', $group_id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function deleteByMenuId($menu_id)
    {
        $builder = $this->db->table('group_permission');
        $builder->where('menu_id', $menu_id);
        $builder->delete();
    }
}
