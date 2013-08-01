<?php

class controller {

    public $view;
    public $model;
    public $load;

    public function __construct($param) {
        $this->load = new load($param);
        $this->view = new view($param);
        $this->model = $this->load->model($param['model_name']);
    }

}

?>
