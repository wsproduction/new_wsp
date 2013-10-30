<?php

class user_model extends model {
    
    public function __construct($param) {
        parent::__construct($param);
    }
    
    private $db_user = 'm_user';
    
    public function user_login($username, $password) {
        $data = array(
            array('email', '=', $username),
            array('password', '=', 'MD5(:password)', false)
        );
        
        $this->db->from($this->db_user);
        $this->db->where($data); 
        $this->db->bind_value(':password', $password);
        return $this->db->fetch();
    }
}

?>
