<?php

class transportation_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }

    private $db_transportation = 'm_transportation';

    public function gender_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->from($this->db_transportation);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);
        return $this->db->fetch();
    }

    public function save_create($data) {
        $data['period_id'] = 'SQL[' . mygenerator::sql_wiht_id('int', $this->db_transportation, 'transportation_id') . ']';
        return $this->db->insert($this->db_transportation, $data);
    }

    public function save_update($data, $condition) {
        return $this->db->update($this->db_transportation, $data, $condition);
    }
    
    public function delete($id) {
        return $this->db->delete($this->db_transportation, array(array('transportation_id', '=', $id)));
    }
    
    public function transportation_options() {
        $option = array('' => ' --- Pilih ---');
        foreach ($this->gender_list()->objects() as $row) {
            $option[$row->transportation_id] = $row->name;
        }
        return $option;
    }

}

?>
