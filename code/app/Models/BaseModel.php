<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    // TEMPLATE BASE MODEL
    public function getAllData($table)
    {
        return $this->db->table($table)->get()->getResult();
    }
    public function getAllDataDesc($table, $col)
    {
        return $this->db->table($table)->orderBy($col, 'DESC')->get()->getResult();
    }
    public function getSelectedData($table, $data)
    {
        return $this->db->table($table)->getWhere($data);
    }
    function updateData($table, $data, $field_key)
    {
        $this->db->table($table)->where($field_key, $field_key)->update($data);
    }
    function deleteData($table, $data)
    {
        $this->db->table($table)->where($data)->delete();
    }
    function insertData($table, $data)
    {
        $this->db->table($table)->insert($data);
    }
    function manualQuery($q)
    {
        return $this->db->query($q);
    }
    function CountData($table)
    {
        return $this->db->table($table)->countAll($table);
    }

    function CountWhere($table, $data)
    {
        $this->db->table($table)->where($data)->get()->getNumRows();
    }

    // CUSTOM BASE MODEL
    public function getSetting($id)
    {
        $result = $this->db->table('conf_sistem')
            ->select('*')
            ->where('id', $id)
            ->get()
            ->getRow();

        return $result;
    }
}
