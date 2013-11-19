<?php

class classroom_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }

    private $db_classroom = 'm_classroom';
    private $db_class_history = 'm_class_history';
    private $db_student = 'm_student';
    private $db_gender = 'm_gender';

    public function classroom_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->from($this->db_classroom);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);
        $this->db->order('classroom_name');
        return $this->db->fetch();
    }

    public function classhistory_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->select(array(
            'a.*',
            'b.*',
            'c.title AS gender_name',
        ));
        $this->db->from($this->db_class_history . ' a');
        $this->db->join($this->db_student . ' b', 'a.student_id = b.student_id');
        $this->db->join($this->db_gender . ' c', 'b.gender = c.gender_id');
        
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);
        return $this->db->fetch();
    }

    public function save_create($data) {
        $data['classroom_id'] = 'SQL[' . mygenerator::sql_wiht_id('int', $this->db_classroom, 'classroom_id') . ']';
        return $this->db->insert($this->db_classroom, $data);
    }

    public function save_update($data, $condition) {
        return $this->db->update($this->db_classroom, $data, $condition);
    }
    
    public function delete($id) {
        return $this->db->delete($this->db_classroom, array(array('MD5(classroom_id)', '=', $id)), true);
    }
    
    public function classroom_options() {
        $option = array('' => ' --- Pilih ---');
        foreach ($this->classroom_list()->objects() as $row) {
            $option[$row->classroom_id] = $row->title;
        }
        return $option;
    }
}

?>
