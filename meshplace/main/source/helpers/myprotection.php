<?php

/*
 * Hello World?
 * My name Warman Suganda, Welcome to my Helper.
 * Enjoyed, ^_^
 */

/*
 * Class Name : myprotection
 * Descrition : 
 * Author : Warman Suganda
 * Email : warman.suganda@gmail.com
 */

class myprotection extends helper {

    public function __construct() {
        parent::__construct();
    }

    public static function login($status = false) {
        if ($status == true) {
            if (session::get('sess_login') == false) {
                url::redirect('login');
            }
        } else {
            if (session::get('sess_login') == true) {
                url::redirect('home');
            }
        }
    }
    
    public static function xhr_result($value) {
        header("Content-Type: application/javascript");
        $result = json_encode($value);
        $script = "while(1){function xhr_result(w,s,p){return {$result}}; break;}";
        echo $script;
    }

}

?>
