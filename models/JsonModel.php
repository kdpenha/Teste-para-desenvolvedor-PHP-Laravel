<?php

class JsonModel {
    protected $file;

    public function __construct($filename) {
        $this->file = __DIR__ . '/../storage/' . $filename . '.json';

        if (!file_exists($this->file)) {
            file_put_contents($this->file, json_encode([]));
        }
    }

    public function all() {
        return json_decode(file_get_contents($this->file), true);
    }

    public function find($id) {
        $items = $this->all();
        return $items[$id] ?? null;
    }

    public function save($data) {
        $items = $this->all();

        if (empty($items)) {
            $id = 1;
        } else {
            $id = max(array_keys($items)) + 1;
        }

        $items[$id] = $data;
        file_put_contents($this->file, json_encode($items, JSON_PRETTY_PRINT));
        return $id;
    }

    public function update($id, $data) {
        $items = $this->all();
        if (isset($items[$id])) {
            $items[$id] = $data;
            file_put_contents($this->file, json_encode($items, JSON_PRETTY_PRINT));
            return true;
        }
        return false;
    }

    public function delete($id) {
        $items = $this->all();
        if (isset($items[$id])) {
            unset($items[$id]);
            file_put_contents($this->file, json_encode($items, JSON_PRETTY_PRINT));
        }
    }

    public function where($field, $value) {
        $items = $this->all();
        $result = [];
    
        foreach ($items as $id => $item) {
            if (isset($item[$field]) && $item[$field] == $value) {
                $result[$id] = $item;
            }
        }
    
        return $result;
    }

    public function firstWhere($field, $value) {
        $items = $this->all();
    
        foreach ($items as $id => $item) {
            if (isset($item[$field]) && $item[$field] == $value) {
                return [$id => $item];
            }
        }
    
        return null;
    }
}
