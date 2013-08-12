<?php

class app_model extends model {
    
    public function __construct($param) {
        parent::__construct($param);
    }
    
    public function app_list($status) {
        $this->db->from('m_application a');
        $this->db->where('a.status', '=', $status);
        $this->db->order('a.order');
        return $this->db->fetch();
    }
    
}

?>
