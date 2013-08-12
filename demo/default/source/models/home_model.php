<?php

class home_model extends model {
    
    public function __construct($param) {
        parent::__construct($param);
    }
    
    public function select_all() {
        $this->db->from('t_meeting a');
        $this->db->join('m_meeting_category b', 'b.category_id = a.category_id');
        //$this->db->where('a.meeting_id', '=', '23');
        $this->db->order('a.name', 'desc');
        $this->db->limit(3);
        return $this->db->fetch();
    }
    
    public function other_db() {
        $this->db2 = $this->db->load('onlinescore');
        $this->db2->from('m_status');
        return $this->db2->fetch();
    }
}

?>
