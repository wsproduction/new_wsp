<?php

class student_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }

    private $db_student = 'm_student';
    private $db_gender = 'm_gender';
    private $db_period = 'm_period';

    public function student_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->select(array(
            'a.*',
            'b.title AS gender_title',
            'c.title AS period'
        ));

        $this->db->from($this->db_student . ' a');
        $this->db->join($this->db_gender . ' b', 'a.gender = b.gender_id');
        $this->db->join($this->db_period . ' c', 'a.period_at = c.period_id');

        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);

        $this->db->order('a.student_id');
        return $this->db->fetch();
    }

    public function save_create($data) {
        $data['student_id'] = 'SQL[' . mygenerator::sql_wiht_id('yymmdd0000', $this->db_student, 'student_id') . ']';
        return $this->db->insert($this->db_student, $data);
    }

    public function save_update($data, $condition) {
        return $this->db->update($this->db_student, $data, $condition);
    }

    public function delete($id) {
        return $this->db->delete($this->db_student, array(array('period_id', '=', $id)));
    }

}

?>
