<?php

class other_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }
    
    public function select_other() {
        echo '<br>this select other model';
    }
}

?>
