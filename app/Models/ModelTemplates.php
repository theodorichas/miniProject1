<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTemplates extends Model
{
    protected $table = 'templates';
    protected $primaryKey = 'template_id';
    protected $allowedFields = ['template_name', 'template_subject', 'template_body', 'created_at', 'updated_at'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function searchAndDisplay($keyword = null, $start = 0, $length = 0, $orderColumn = 'template_name', $orderDirection = 'asc')
    {
        $builder = $this->table('templates');

        if ($keyword) {
            $arr_keyword = explode(" ", $keyword);
            for ($i = 0; $i < count($arr_keyword); $i++) {
                $builder->groupStart();
                $builder->orLike('template_name', $arr_keyword[$i]);
                $builder->orLike('template_subject', $arr_keyword[$i]);
                $builder->orLike('template_body', $arr_keyword[$i]);
                $builder->groupEnd();
            }
        }

        if ($start != 0 or $length != 0) {
            $builder->limit((int)$length, (int)$start);
        }
        $builder->orderBy($orderColumn, $orderDirection);
        return $builder->get()->getResult();
    }

    public function add_template($data)
    {
        $builder = $this->table('templates');
        $builder->table('templates')->insert($data);
    }

    public function update_template($data, $template_id)
    {
        $builder = $this->db->table('templates');
        $builder->where('template_id', $template_id);
        $builder->update($data);
    }

    public function delete_template($template_id)
    {
        return $this->delete($template_id);
    }

    //Dipakai di pdf Controller untuk mengambil value dari templates
    public function getTemplates()
    {
        $builder = $this->db->table('templates');
        $builder->select('*');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    //Dipakai di pdf index view untuk mengambil template body
    public function getTemplateBody($templateId)
    {
        $builder = $this->db->table('templates');
        $builder->select('template_body');
        $builder->where('template_id', $templateId);
        $query = $builder->get();
        return $query->getRow();
    }

    public function fetchTemplateBody($template_name)
    {
        $builder = $this->db->table('templates');
        $builder->select('template_body');
        $builder->where('template_id', $template_name);
        $query = $builder->get();
        return $query->getRow();
    }
}
