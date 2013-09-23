<?php

class home extends controller {

    public function __construct($param) {
        parent::__construct($param);
        scurity::page_cache('Tue, 01 Jan 2000 00:00:00');
        // myprotection::login(true);
    }

    public function index() {        
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();
        $this->view->render('home/index');
    }

}

?>
