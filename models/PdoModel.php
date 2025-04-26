<?php

class PdoModel {
    protected $db;
    protected $table;

    public function __construct($table) {
        $this->db = (new Database())->connect();
        $this->table = $table;
    }

    // Buscar todos os registros
    public function all() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar um único registro pelo ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Salvar novo registro
    public function save($data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_map(function ($key) { return ":$key"; }, array_keys($data)));

        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return $this->db->lastInsertId(); // Retorna o ID gerado
    }

    // Atualizar um registro
    public function update($id, $data) {
        $set = implode(', ', array_map(function ($key) { return "$key = :$key"; }, array_keys($data)));

        $stmt = $this->db->prepare("UPDATE {$this->table} SET $set WHERE id = :id");
        $stmt->bindParam(':id', $id);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    // Deletar um registro
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Realizar um "WHERE" para filtrar
    public function where($field, $value) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE $field = :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Realizar um "WHERE" para pegar o primeiro item
    public function firstWhere($field, $value) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE $field = :value LIMIT 1");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
