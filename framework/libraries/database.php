<?php

class database {

    private $param;
    private $query;
    private $pdo;

    public function __construct($param) {
        $this->param = $param;
        $this->reset_query();
        $this->pdo = $this->load($this->param['active_db']);
    }

    public function load($active_db) {
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

    public function from($table) {
        $this->query['from'] = $table;
    }

    public function get() {
        $sql = $this->sql();
        return $sql;
    }

    private function sql() {
        $sql = '';
        $sql .= 'SELECT ' . $this->query['select'] . ' ';
        $sql .= 'FROM ' . $this->query['from'] . ' ';
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->execute();
            return new db_result($sth->fetchAll());
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}

class db_result {

    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function result() {
        return $this->object_result($this->data);
    }

    private function object_result($array) {
        $object = array();
        foreach ($array as $value) {
            $object[] = (object) $value;
        }
        return $object;
    }

}

?>
