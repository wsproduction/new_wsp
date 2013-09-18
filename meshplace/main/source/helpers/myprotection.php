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

}

?>
