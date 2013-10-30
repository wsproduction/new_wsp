<?php

/*
 * Hello World?
 * My name Warman Suganda, Welcome to my Helper.
 * Enjoyed, ^_^
 */

/*
 * Class Name : mygenerator
 * Descrition : 
 * Author : Warman Suganda
 * Email : warman.suganda@gmail.com
 */

class mygenerator extends helper {

    public function __construct() {
        parent::__construct();
    }
    
    public static function sql_wiht_id($type, $table, $key) {
        $sql = '';
        if ($type == 'int') {
            $sql .= 'SELECT IF(
                        (SELECT COUNT(a.' . $key . ') 
                         FROM ' . $table . ' AS a) > 0, 
                            (SELECT a.' . $key . ' 
                             FROM ' . $table . ' AS a 
                             ORDER BY a.' . $key . ' DESC LIMIT 1) + 1,
                        1)';
        }
        
        return $sql;
    }
    
}

?>
