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
        } else if ($type == 'yymmdd0000') {
            $sql .= 'SELECT IF (
                        (SELECT COUNT(a.' . $key . ') FROM ' . $table . ' AS a 
                                WHERE a.' . $key . '  LIKE  (SELECT CONCAT(DATE_FORMAT(CURDATE(),"%y%m%d"),"%"))
                        ) > 0,
                        (SELECT ( a.' . $key . ' + 1 ) FROM  ' . $table . ' AS a 
                                WHERE a.' . $key . '  LIKE  (SELECT CONCAT(DATE_FORMAT(CURDATE(),"%y%m%d"),"%"))
                                ORDER BY a.' . $key . ' DESC LIMIT 1),
                        (SELECT CONCAT(DATE_FORMAT(CURDATE(),"%y%m%d"),"0001"))
                    )';
        }

        return $sql;
    }

    public static function wizard_steps($type = 1, $list = array(), $step_active = 1) {
        $idx = 0;
        $html = '<ul class="wizard-steps steps-' . $type . '">';
        foreach ($list as $val) {
            $idx++;
            $active = '';
            if ($idx == $step_active)
                $active = 'active';
            $html .= '<li class="' . $active . '">
                        <div class="single-step">
                            <span class="title">' . $idx . '</span>
                            <span class="circle">
                                <span class="' . $active . '"></span>
                            </span>
                            <span class="description">
                                ' . $val . '
                            </span>
                        </div>
                    </li>';
        }
        $html .= '</ul>';
        return $html;
    }

}

?>
