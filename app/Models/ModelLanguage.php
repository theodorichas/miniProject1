<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLanguage extends Model
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    protected $table = 'translations';
    protected $allowedFields = ['key', 'en', 'indo'];
    protected $primaryKey = 'langId'; // Assuming 'id' is your primary key.


    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $orderColumn = 'key', $orderDirection = 'asc')
    {
        $builder = $this->table('translations');

        if ($keyword) {
            $arr_keyword = explode(" ", $keyword);
            for ($i = 0; $i < count($arr_keyword); $i++) {
                $builder->groupStart();
                $builder->orLike('key', $arr_keyword[$i]);
                $builder->orLike('en', $arr_keyword[$i]);
                $builder->orLike('indo', $arr_keyword[$i]);
                $builder->groupEnd();
            }
        }

        if ($start != 0 or $length != 0) {
            $builder->limit((int)$length, (int)$start);
        }
        $builder->orderBy($orderColumn, $orderDirection);
        return $builder->get()->getResult();
    }

    public function getLanguages()
    {
        return ['en', 'indo'];
    }

    public function add_lang($data)
    {
        $builder = $this->table('translations');
        $builder->table('translations')->insert($data);
    }

    public function update_lang($langId, $data)
    {
        $builder = $this->db->table('translations');
        $builder->where('langId', $langId);
        $builder->update($data);
    }

    public function delete_lang($langId)
    {
        return $this->delete($langId);
    }
}
