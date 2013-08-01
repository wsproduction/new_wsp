<?php

class load {

    private $param;

    public function __construct($param) {
        $this->param = $param;
    }

    public function model($name) {
        $model = $this->param['source_path'] . '/models/' . $name . '.php';
        if (file_exists($model)) {
            require_once($model);
            if (class_exists($name)) {
                return new $name($this->param);
            } else {
                // Tampilakan pesan error
                // exit;
                return false;
            }
        }
    }

}