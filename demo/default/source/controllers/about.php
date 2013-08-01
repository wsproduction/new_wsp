<?php

class about extends controller {
    public function __construct($param) {
        parent::__construct($param);
    }
    
    public function index() {
        echo 'ini abbout';
        $this->view->render();
    }
    
    
}

?>
