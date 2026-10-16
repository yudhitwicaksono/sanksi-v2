<?php

namespace App\Models;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function Login($user, $pass)
    {
        return $this->db->table('user')
            ->where('username', $user)
            ->where('password', $pass)
            ->get();
    }

    public function Code($query)
    {
        $res = $this->db->query($query);
        return $res ? $res->getResultArray() : [];
    }

    public function LastId($kolom, $table)
    {
        $res = $this->db->query("SELECT MAX($kolom) AS LastIdFix FROM $table");
        return $res ? $res->getResultArray() : [];
    }

    public function View($table, $order)
    {
        return $this->db->table($table)
            ->orderBy($order, 'DESC')
            ->get()
            ->getResultArray();
    }

    public function ViewASC($table, $order)
    {
        return $this->db->table($table)
            ->orderBy($order, 'ASC')
            ->get()
            ->getResultArray();
    }

    public function ViewLimit($table, $order, $limit)
    {
        return $this->db->table($table)
            ->orderBy($order, 'DESC')
            ->limit((int)$limit)
            ->get()
            ->getResultArray();
    }

    public function ViewWhere($table, $whereField, $whereValue)
    {
        return $this->db->table($table)
            ->where($whereField, $whereValue)
            ->get()
            ->getResultArray();
    }

    public function ViewWhereAktor($table, $whereField, $whereValue)
    {
        return $this->db->table($table)
            ->where($whereField, $whereValue)
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function Insert($table, $value)
    {
        return $this->db->table($table)->insert($value);
    }

    public function Update($table, $where, $whereValue, $value)
    {
        return $this->db->table($table)
            ->where($where, $whereValue)
            ->update($value);
    }

    public function Delete($table, $where, $whereValue)
    {
        return $this->db->table($table)
            ->where($where, $whereValue)
            ->delete();
    }

    public function GetId($id, $table)
    {
        $res = $this->db->query("SELECT MAX($id) FROM $table");
        return $res ? $res->getResultArray() : [];
    }
}
