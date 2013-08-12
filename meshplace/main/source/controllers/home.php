<?php

class home extends controller {

    public function __construct($param) {
        parent::__construct($param);
    }

    public function index() {
        $this->view->app = $this->app_model->app_list(1);
        $this->view->render('home/index');
    }

}

?>
