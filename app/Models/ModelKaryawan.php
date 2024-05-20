<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKaryawan extends Model
{
    protected $table = 'karyawan';
    protected $allowedFields = ['nama', 'telp', 'alamat', 'email', 'password', 'group_name'];
    protected $primaryKey = 'user_id'; // Assuming 'id' is your primary key.

    public function __construct()
    {
        $this->db      = \Config\Database::connect();
        // $this->builder = $this->db->table('karyawan');
        // $this->ModelKaryawan = new ModelKaryawan();
    }

    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $orderColumn = 'nama', $orderDirection = 'asc')
    {
        $builder = $this->table('karyawan');

        if ($keyword) {
            $arr_keyword = explode(" ", $keyword);
            for ($i = 0; $i < count($arr_keyword); $i++) {
                $builder->groupStart();
                $builder->orLike('nama', $arr_keyword[$i]);
                $builder->orLike('telp', $arr_keyword[$i]);
                $builder->orLike('alamat', $arr_keyword[$i]);
                $builder->orLike('email', $arr_keyword[$i]);
                $builder->orLike('password', $arr_keyword[$i]);
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

    public function getGroupNames() //ambil group names untuk select options di modal
    {
        $builder = $this->db->table('group');
        $builder->select('group_name');
        $query = $builder->get();

        $group_names = [];
        foreach ($query->getResult() as $row) {
            $group_names[] = $row->group_name;
        }
        return $group_names;
    }

    //insert data
    public function add_dataKaryawan($data)
    {
        $builder = $this->table('karyawan');
        $builder->table('karyawan')->insert($data);
    }

    public function getGroupIdByName($group_name)
    {
        $builder = $this->db->table('group');
        $builder->select('group_id');
        $builder->where('group_name', $group_name);

        $query = $builder->get();
        if ($query->getNumRows() > 0) {
            // Fetch the first row and return the group_id
            $row = $query->getRow();
            return $row->group_id;
        } else {
            // Return null if no group_id is found
            return null;
        }
    }

    public function insertUserGroup($user_id, $group_id)
    {
        $builder = $this->db->table('user_group');
        $data = [
            'user_id' => $user_id,
            'group_id' => $group_id
        ];
        $builder->insert($data);
    }


    /// Update data ////

    public function update_dataKaryawan($id, $data, $group_id)
    {
        $builder = $this->db->table('karyawan');
        $builder->where('user_id', $id);
        $builder->update($data);
        $this->updateUserGroup($id, $group_id);
    }

    public function updateUserGroup($user_id, $group_id)
    {
        $builder = $this->db->table('user_group');
        $builder->where('user_id', $user_id);
        $builder->update(['group_id' => $group_id]);
    }

    ///// ----------- ///////


    /// delete data ///
    public function delete_dataKaryawan($id)
    {
        return $this->delete($id);
    }
    ///// ----------- ///////

    public function getUserByEmail($email)
    {
        $builder = $this->db->table('karyawan');
        $builder->select('*');
        $builder->where('email', $email);
        $user = $builder->get()->getRowArray();
        return $user;
    }

    public function emailValid($email)
    {
        $builder = $this->db->table('karyawan');
        $builder->select('email');
        $builder->where('email', $email);
        $user = $builder->get()->getFirstRow();
        return $user;
    }
}
