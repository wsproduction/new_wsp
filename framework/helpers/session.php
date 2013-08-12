<?php

class session extends helper {

    public function __construct() {
        parent::__construct();
    }

    public static function init() {
        @session_start();
    }

    public static function set($key, $value = '') {
        if (is_array($key)) {
            foreach ($key as $a => $b) {
                self::set($a, $b);
            }
        } else {
            $_SESSION[$key] = $value;
        }
    }

    public static function get($key) {
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
        else
            return false;
    }

    public static function destroy() {
        session_destroy();
    }

    public static function id() {
        return session_id();
    }

}