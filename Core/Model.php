<?php

namespace Core;

use Database\Connection;
use Database\QuerySelect;
use Database\SelectBuilder;


 class Model{
    protected Connection $db;
    protected string $table;
    protected string $pk;

    public function __construct(){
        $this->db = Connection::getInstance();
    }

    public function all() : array{
        return $this->selector()->get();
    }

    public function find(int $id) : ?array{
        $res = $this->selector()->where("{$this->pk} = :pk", ['pk' => $id])->get();
        return $res[0] ?? null;
    }

    public function selector() : QuerySelect{
        $builder = new SelectBuilder($this->table);
        return new QuerySelect($this->db, $builder);
    }

    public function add(array $fields) : int{
        $rules = $this->rebuildRules($this->validationRules);
        $validation = $this->validator->validate($fields, $rules);

        if($validation->fails()){
            throw new ExcValidation('cant add article', $validation->errors());
        }

        $names = [];
        $masks = [];

        foreach($fields as $field => $val){
            $names[] = $field;
            $masks[] = ":$field";
        }

        $namesStr = implode(', ', $names);
        $masksStr = implode(', ', $masks);

        $query = "INSERT INTO {$this->table} ($namesStr) VALUES ($masksStr)";
        $this->db->query($query, $fields);
        return $this->db->lastInsertId();
    }

    public function remove(int $id) : bool{
        $query = "DELETE FROM {$this->table} WHERE {$this->pk} =:pk";
        $query = $this->db->query($query, ['pk' => $id]);
        return $query->rowCount() > 0;
    }

    public function edit(int $id, array $fields) : bool{
        $rules = $this->rebuildRules($this->validationRules, $id);
        $validation = $this->validator->validate($fields, $rules);

        if($validation->fails()){
            throw new ExcValidation('cant add article', $validation->errors());
        }

        $pairs = [];

        foreach($fields as $field => $val){
            $pairs[] = "$field=:$field";
        }

        $pairsStr = implode(', ', $pairs);

        $query = "UPDATE {$this->table} SET $pairsStr WHERE {$this->pk} =:{$this->pk}";
        $this->db->query($query, $fields + [$this->pk => $id]);
        return true;
    }
}