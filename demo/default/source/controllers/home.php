<?php

class home extends controller {

    public function __construct($param) {
        parent::__construct($param);
    }

    public function index() {
        
        $db2 = $this->model->other_db();
        $db = $this->model->select_all();
        
        $this->view->test_variable = 'ini variable dari controller';
        $this->view->test_variable_array = array(1,2,3);
        $this->view->test_model = $db->objects();
        $this->view->test_model2 = $db2->arrays();
        $this->view->render('home');
    }

    public function myname($firstname, $midname, $lastname) {
        echo 'First Name ' . $firstname . '<br>';
        echo 'Mid Name ' . $midname;
        echo 'Last Name ' . $lastname;
    }

}

?>
