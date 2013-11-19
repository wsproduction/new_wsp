<?php

class database {

    private $param;
    private $query;
    private $pdo;
    private $_status_transaction = 0;
    private $temp_sql;

    public function __construct($param) {
        $this->param = $param;
        $this->reset_query();
        $this->pdo = $this->connect($this->param['active_db']);
    }

    /*
     * Method untuk meload koneksi database baru
     */

    public function load($active_db) {
        $param = $this->param;
        $param['active_db'] = $active_db;
        return new database($param);
    }

    /*
     * Method untuk menghubungkan ke database
     */

    private function connect($active_db) {
        if ($active_db) {
            $db = $this->param['db'][$active_db];
            switch ($db['dbdriver']) {
                case 'mysql':
                    $dsn = 'mysql:host=' . $db['hostname'] . ';dbname=' . $db['database'];
                    break;
                case 'odbc':
                    $dsn = 'odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=' . $db['hostname'];
                    break;
                default:
                    break;
            }
            return new PDO($dsn, $db['username'], $db['password']);
        }
    }

    /*
     * Method untuk mereset variable query
     */

    private function reset_query() {
        $this->query['select'] = '*';
        $this->query['from'] = '';
        $this->query['where'] = array();
        $this->query['bind_value'] = array();
        $this->query['set'] = array();
        $this->query['join'] = array();
        $this->query['limit'] = array();
        $this->query['order'] = array();
    }

    /*
     * Method untuk mendaftarkan field apa saja yang akan ditampilkan
     * Bisa berupa array atau string
     */

    public function select($attribut = array()) {
        if (is_array($attribut)) {
            // ini dijalankan ketika attribut selectnya berupa array
            $count = count($attribut);
            if ($count) {
                $select = '';
                $idx = 0;
                foreach ($attribut as $value) {
                    $select .= $value;
                    $idx++;
                    if ($idx < $count)
                        $select .= ',';
                }
                $this->query['select'] = $select;
            }
        } else {
            // ini dijalankan ketika attribut selectnya berupa string
            $attribut = trim($attribut);
            if (!empty($attribut)) {
                $this->query['select'] = $attribut;
            }
        }
    }

    /*
     * Method untuk menambahkan kondisi query
     */

    public function where($attribut = '', $expression = '', $keyword = null, $bind_value = true, $condition = 'AND') {
        if (is_array($attribut)) {
            foreach ($attribut as $value) {
                $attribut = '';
                if (isset($value[0]))
                    $attribut = $value[0];

                $expression = '';
                if (isset($value[1]))
                    $expression = $value[1];

                $keyword = null;
                if (isset($value[2]))
                    $keyword = $value[2];

                $bind_value = true;
                if (isset($value[3]))
                    $bind_value = $value[3];

                $condition = 'AND';
                if (isset($value[4]))
                    $condition = $value[4];

                $this->query['where'][] = array(
                    'attribut' => $attribut,
                    'expression' => $expression,
                    'keyword' => $keyword,
                    'bind_value' => $bind_value,
                    'condition' => $condition
                );
            }
        } else {
            $this->query['where'][] = array(
                'attribut' => $attribut,
                'expression' => $expression,
                'keyword' => $keyword,
                'bind_value' => $bind_value,
                'condition' => $condition
            );
        }
    }

    /*
     * Method untuk menentukan nama table yang akan di select
     */

    public function from($table) {
        $this->query['from'] = $table;
    }

    /*
     * Method untuk menentukan nama table yang akan di select
     */

    public function set($data = array()) {
        $this->query['set'] = $data;
    }

    /*
     * Method untuk menghubungkan antar tabel
     */

    public function join($table, $condition, $type = 'INNER') {
        $this->query['join'][] = array(
            'table' => $table,
            'condition' => $condition,
            'type' => $type
        );
    }

    /*
     * Method untuk menghubungkan antar tabel
     */

    public function limit($value, $offset = '') {
        $this->query['limit'] = array(
            'value' => $value,
            'offset' => $offset
        );
    }

    public function order($by, $direction = '') {
        $this->query['order'] = array(
            'by' => $by,
            'direction' => $direction
        );
    }

    /*
     * Method untuk mengambil data hasil query
     */

    public function fetch() {
        $result = $this->sql_select();
        return $result;
    }

    /*
     * Method untuk mengambil jumlah data
     */

    public function num_rows() {
        $result = $this->sql_select();
        return $result->num_rows();
    }

    /*
     * Method untuk mengambil data berdasarkan index row
     */

    public function row($index = 0, $type = 'object') {
        $result = $this->sql_select();
        if ($type == 'object') {
            $data = $result->objects();
        } else {
            $data = $result->arrays();
        }
        if (isset($data[$index])) {
            return $data[$index];
        } else {
            return false;
        }
    }

    /*
     * Method untuk menghapus data
     */

    public function delete($table, $condition = array()) {
        $this->from($table);
        $this->where($condition);
        return $this->sql_delete();
    }

    /*
     * Method untuk mengupdate data
     */

    public function update($table, $data = array(), $condition = array()) {
        $this->from($table);
        $this->set($data);
        $this->where($condition);
        return $this->sql_update();
    }

    /*
     * Method untuk menginsert data
     */

    public function insert($table, $data = array()) {
        $this->from($table);
        $this->set($data);
        return $this->sql_insert();
    }

    /*
     * Method untuk menggabungkan query menjadi sebuah sql select untuk dieksekusi
     */

    private function sql_select() {
        $sql = '';
        $sql .= 'SELECT ' . $this->query['select'] . ' ';
        $sql .= 'FROM ' . $this->query['from'] . ' ';
        $sql .= $this->sql_join();
        $sql .= $this->sql_where();
        $sql .= $this->sql_order();
        $sql .= $this->sql_limit();
        return $this->sql_generate($sql, 'data');
    }

    /*
     * Method untuk menggabungkan query menjadi sebuah sql update untuk dieksekusi
     */

    private function sql_update() {
        $sql = '';
        $sql .= 'UPDATE ' . $this->query['from'] . ' ';
        $sql .= $this->sql_set_update() . ' ';
        $sql .= $this->sql_where();
        return $this->sql_generate($sql);
    }

    /*
     * Method untuk menggabungkan query menjadi sebuah sql insert untuk dieksekusi
     */

    private function sql_insert() {
        $sql = '';
        $sql .= 'INSERT INTO ' . $this->query['from'] . ' ';
        $sql .= $this->sql_set_insert();
        return $this->sql_generate($sql);
    }

    /*
     * Method untuk menggabungkan query menjadi sebuah sql delete untuk dieksekusi
     */

    private function sql_delete() {
        $sql = '';
        $sql .= 'DELETE ';
        $sql .= 'FROM ' . $this->query['from'] . ' ';
        $sql .= $this->sql_where();
        return $this->sql_generate($sql);
    }

    /*
     * Method untuk menggabungkan kondisi sql
     */

    private function sql_where() {
        $sql = '';
        $where_array = $this->query['where'];
        $where_count = count($where_array);
        if ($where_count > 0) {
            $where = 'WHERE ';
            $idx = 0;
            foreach ($where_array as $value) {
                $expression = $value['expression'];
                $keyword = $value['keyword'];
                $bind_value = $value['bind_value'];

                if ($idx > 0) {
                    $where .= $value['condition'] . ' ';
                }

                if (in_array(strtolower($expression), array('in', 'not in'))) {
                    $binder_list = '';
                    if (!is_array($keyword)) {
                        $keyword = explode(',', $keyword);
                    }

                    $keyword_count = count($keyword);
                    $keyword_idx = 0;
                    foreach ($keyword as $kwd) {
                        $binder = ':wsf_param_where_' . date('YmdHis') . '_' . $idx . '_' . $keyword_idx;
                        $this->bind_value($binder, $kwd);
                        $binder_list .= $binder;
                        $keyword_idx++;
                        if ($keyword_count != $keyword_idx) {
                            $binder_list .= ', ';
                        }
                    }

                    $parameter = '(' . $binder_list . ')';
                } else if (in_array(strtolower($expression), array('between'))) {
                    if (!is_array($keyword)) {
                        list($keyword_start, $keyword_end) = explode('=>', $keyword);
                    }

                    $binder_start = ':wsf_param_where_' . date('YmdHis') . '_' . $idx . '_start';
                    $binder_end = ':wsf_param_where_' . date('YmdHis') . '_' . $idx . '_end';
                    $this->bind_value($binder_start, $keyword_start);
                    $this->bind_value($binder_end, $keyword_end);
                    $parameter = $binder_start . ' AND ' . $binder_end . ' ';
                } else {

                    if ($bind_value) {
                        $parameter = ':wsf_param_where_' . date('YmdHis') . '_' . $idx;
                        $this->bind_value($parameter, $keyword);
                    } else {
                        $parameter = $keyword;
                    }

                    if (is_null($keyword) && $expression == '=') {
                        $expression = 'IS';
                    } else if (is_null($keyword) && $expression == '<>') {
                        $expression = 'IS NOT';
                    }
                }

                $where .= $value['attribut'] . ' ' . $expression . ' ' . $parameter . ' ';
                $idx++;
            }
            $sql .= $where;
        }
        return $sql;
    }

    /*
     * Method untuk menggabungkan sql data update
     */

    private function sql_set_update() {
        $sql = 'SET ';
        $count_set = count($this->query['set']);
        $idx = 0;
        foreach ($this->query['set'] as $key => $value) {
            $parameter = ':wsf_param_set_update_' . date('YmdHis') . '_' . $idx;
            $this->bind_value($parameter, $value);
            $sql .= $key . ' = ' . $parameter;
            $idx++;
            if ($idx != $count_set) {
                $sql .= ', ';
            } else {
                $sql .= ' ';
            }
        }
        return $sql;
    }

    /*
     * Method untuk menggabungkan sql data insert
     */

    private function sql_set_insert() {
        $sql_field = '(';
        $sql_values = '(';
        $count_set = count($this->query['set']);
        $idx = 0;
        foreach ($this->query['set'] as $key => $value) {
            if (preg_match('/^SQL\[/', $value)) {
                $parameter = $this->replace_sql($value);
            } else {
                $parameter = ':wsf_param_set_insert_' . date('YmdHis') . '_' . $idx;
                $this->bind_value($parameter, $value);
            }

            $sql_field .= $key;
            $sql_values .= $parameter;

            $idx++;
            if ($idx != $count_set) {
                $sql_field .= ', ';
                $sql_values .= ', ';
            } else {
                $sql_field .= ') ';
                $sql_values .= ') ';
            }
        }

        $sql = $sql_field . ' VALUES ' . $sql_values;

        return $sql;
    }

    /*
     * Method untuk menggabungkan sql join
     */

    private function sql_join() {
        $sql = '';
        foreach ($this->query['join'] as $value) {
            $sql .= $value['type'] . ' JOIN ' . $value['table'] . ' ON ' . $value['condition'] . ' ';
        }
        return $sql;
    }

    /*
     * Method untuk menggabungkan sql order by
     */

    private function sql_order() {
        $sql = '';
        $order = $this->query['order'];
        if (isset($order['by']) && isset($order['direction'])) {
            $sql .= 'ORDER BY ' . $order['by'] . ' ' . $order['direction'] . ' ';
        }
        return $sql;
    }

    /*
     * Method untuk menggabungkan sql order by
     */

    private function sql_limit() {
        $sql = '';
        $order = $this->query['limit'];
        if (isset($order['value']) && isset($order['offset'])) {
            if (!empty($order['value']) && !empty($order['offset'])) {
                $sql .= 'LIMIT ' . $order['offset'] . ' ';
                $sql .= ', ' . $order['value'] . ' ';
            } else {
                $sql .= 'LIMIT ' . $order['value'] . ' ';
            }
        }
        return $sql;
    }

    /*
     * Method untuk menginisalisasi value
     */

    public function bind_value($parameter, $value = null) {
        if (is_array($parameter)) {
            foreach ($parameter as $key => $value) {
                $this->query['bind_value'][$key] = $value;
            }
        } else {
            $this->query['bind_value'][$parameter] = $value;
        }
    }

    /*
     * Method untuk mengeksekusi sql
     */

    private function sql_generate($sql, $return = 'bool') {
        try {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $sth = $this->pdo->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);

            foreach ($this->query['bind_value'] as $key => $value) {
                if (is_int($value))
                    $param = PDO::PARAM_INT;
                else if (is_bool($value))
                    $param = PDO::PARAM_BOOL;
                else if (is_null($value))
                    $param = PDO::PARAM_NULL;
                else if (is_string($value))
                    $param = PDO::PARAM_STR;
                else
                    $param = FALSE;

                $sth->bindValue($key, $value, $param);
            }

            $this->reset_query();

            if ($return == 'data') {
                $sth->execute();
                return new fetch_db($sth->fetchAll());
            } else {
                return $sth->execute();
            }
        } catch (PDOException $e) {
            $this->_status_transaction += 1;
            echo $e->getMessage();
            return false;
        }
    }

    /*
     * Last Insert ID
     */

    public function last_insert_id() {
        $this->pdo->lastInsertId();
    }

    /*
     * Begin Transaction
     */

    public function begin_transaction() {
        $this->pdo->beginTransaction();
    }

    /*
     * Commit Transaction
     */

    public function commit_transaction() {
        $this->pdo->commit();
    }

    /*
     * Rollback Transaction
     */

    public function rollback_transaction() {
        $this->pdo->rollback();
    }

    /*
     * Status Transaction
     */

    public function status_transaction() {
        if ($this->_status_transaction == 0)
            return true;
        else
            return false;
    }

    /*
     * Replace SQL
     */

    private function replace_sql($value) {
        $value = str_replace('SQL[', '(', $value);
        $value = str_replace(']', ')', $value);
        $value = str_replace(array("\n", "\r\n", "\r"), ' ', $value);
        $value = preg_replace("/[\t\s]+/", " ", trim($value));;
        return $value;
    }
    
}

/*
 * Class untuk mengambil data hasil query
 */

class fetch_db {

    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    /*
     * Method untuk mengambil data hasil query berupa object
     */

    public function objects() {
        return $this->array_to_object($this->data);
    }

    /*
     * Method untuk mengambil data hasil query berupa array
     */

    public function arrays() {
        return $this->data;
    }

    /*
     * Method untuk mengambil jumlah data
     */

    public function num_rows() {
        return count($this->data);
    }

    /*
     * Method untuk mengambil data hasil query berdasarkan index row
     */

    public function row($index = 0, $fetch = 'objects') {
        if ($fetch == 'arrays') {
            $data = $this->arrays();
        } else {
            $data = $this->objects();
        }
        if (count($data) > 0)
            $result = $data[$index];
        else
            $result = false;
        return $result;
    }

    /*
     * Method untuk merubah dari array ke object
     */

    private function array_to_object($array) {
        $object = array();
        foreach ($array as $value) {
            $object[] = (object) $value;
        }
        return $object;
    }

}

?>
