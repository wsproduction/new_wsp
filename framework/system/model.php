<?php

class model {

    private $param;
    public $db;

    public function __construct($param) {
        $this->param = $param;
        $this->db = new database($param['config']['database']);
    }

}
