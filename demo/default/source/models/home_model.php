<?php

class home_model extends model {
    
    public function __construct($param) {
        parent::__construct($param);
    }
    
    public function select_all() {
        //$this->db->select(array('a', 'b', 'c'));
        $this->db->from('t_meeting');
        return $this->db->get();
    }
}

?>
