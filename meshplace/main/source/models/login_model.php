<?php

class login_model extends model {
    
    public function __construct($param) {
        parent::__construct($param);
    }
    
    public function user($data) {
        $this->db->from('m_user');
        $this->db->where($data);
        return $this->db->fetch();
    }
}

?>
