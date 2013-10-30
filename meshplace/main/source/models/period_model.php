<?php

class period_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }

    private $db_period = 'm_period';

    public function period_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->from($this->db_period);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);
        $this->db->order('period_id');
        return $this->db->fetch();
    }

    public function save_create($data) {
        $data['period_id'] = 'SQL[' . mygenerator::sql_wiht_id('int', $this->db_period, 'period_id') . ']';
        return $this->db->insert($this->db_period, $data);
    }

    public function save_update($data, $condition) {
        return $this->db->update($this->db_period, $data, $condition);
    }
    
    public function delete($id) {
        return $this->db->delete($this->db_period, array(array('period_id', '=', $id)));
    }

}

?>
