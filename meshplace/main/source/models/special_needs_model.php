<?php

class special_needs_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }

    private $db_special_needs = 'm_special_needs';

    public function special_needs_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->from($this->db_special_needs);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);
        return $this->db->fetch();
    }

    public function save_create($data) {
        $data['special_needs_id'] = 'SQL[' . mygenerator::sql_wiht_id('int', $this->db_special_needs, 'special_needs_id') . ']';
        return $this->db->insert($this->db_special_needs, $data);
    }

    public function save_update($data, $condition) {
        return $this->db->update($this->db_special_needs, $data, $condition);
    }
    
    public function delete($id) {
        return $this->db->delete($this->db_special_needs, array(array('special_needs_id', '=', $id)));
    }
    
    public function special_needs_options() {
        $option = array('' => ' --- Pilih ---');
        foreach ($this->special_needs_list()->objects() as $row) {
            $option[$row->special_needs_id] = $row->name;
        }
        return $option;
    }
}

?>
