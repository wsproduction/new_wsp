<?php

class app_model extends model {
    
    public function __construct($param) {
        parent::__construct($param);
    }
    
    public function app_list($where = array()) {
        $this->db->from('m_application');
        $this->db->where($where);
        return $this->db->fetch();
    }
    
}

?>
