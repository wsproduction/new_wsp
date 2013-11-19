<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Method
 *
 * @author ws
 */
class input {

    private $param;
    private $value;
    private $validation;
    private $message;
    private $validation_list = array('requaired' => 'The :title is requaired', 'callback' => '');

    public function __construct($param) {
        $this->param = $param;
    }

    public function post($variable_name = '', $title = '', $validation = array(), $trim = true) {
        $res = null;
        if (isset($_POST[$variable_name])) {
            $temp_value = $_POST[$variable_name];
            if (!is_array($temp_value)) {
                $val = $temp_value;
                if ($trim)
                    $val = trim($temp_value);
                if ($val != '') {
                    $res = $val;
                }
            } else {
                $res = $val;
            }
        }

        // Set Title
        if (empty($title))
            $title = $variable_name;
        $this->message[$variable_name]['title'] = $title;

        // Append Validation
        $this->value[$variable_name] = $res;
        if (is_array($validation) && count($validation) > 0) {
            $this->validation[$variable_name] = $validation;
        }

        return $res;
    }

    public function get($variable_name = '', $title = '', $validation = array()) {
        $res = null;
        if (isset($_GET[$variable_name])) {
            $temp_value = $_GET[$variable_name];
            if (!is_array($temp_value)) {
                $val = trim($temp_value);
                if ($val != '') {
                    $res = $val;
                }
            } else {
                $res = $val;
            }
        }

        // Set Title
        if (empty($title))
            $title = $variable_name;
        $this->message[$variable_name]['title'] = $title;

        // Append Validation
        $this->value[$variable_name] = $res;
        if (is_array($validation) && count($validation) > 0) {
            $this->validation[$variable_name] = $validation;
        }

        return $res;
    }

    public function files($variable_name = '', $content = '') {
        return $_FILES[$variable_name][$content];
    }

    public function is_ajax() {
        $bool = false;
        if (isset($_SERVER['HTTP_REFERER'])) {
            $bool = true;
        }
        return $bool;
    }

    public function set_message($validation, $message) {
        $this->validation_list[$validation] = $message;
    }

    public function validation() {

        $error = 0;
        if (count($this->validation)) {
            foreach ($this->validation as $variable_name => $rules) {
                foreach ($rules as $funct => $param) {
                    if (isset($this->validation_list[$funct])) {
                        if ($this->$funct($this->value[$variable_name], $param)) {
                            $status = true;
                        } else {
                            $error++;
                            $status = false;
                        }

                        if ($funct == 'callback')
                            $funct = $param;

                        $this->set_status($variable_name, $funct, $status);
                    }
                }
            }
        }

        if ($error == 0)
            return true;
        else
            return false;
    }

    private function set_status($form, $validation, $status) {
        $this->message[$form]['status'][$validation] = $status;
    }

    public function validation_message() {
        $show_message = '';
        if (count($this->message)) {
            foreach ($this->message as $key => $msg) {
                $title = $key;
                if (isset($msg['title'])) {
                    $temp_title = trim($msg['title']);
                    if (!empty($temp_title))
                        $title = $temp_title;
                }

                foreach ($this->validation_list as $val => $default_message) {
                    if (isset($msg['status'][$val])) {
                        if (!$msg['status'][$val]) {
                            $message = str_replace(':title', $title, $default_message);
                            $show_message .= '<div>' . $message . '</div>';
                            break;
                        }
                    }
                }
            }
        }
        return $show_message;
    }

    /* Daftar Fungsi Validasi input */

    private function requaired($value, $callback) {
        $a = trim($value);
        if ($callback) {
            if (empty($a))
                return false;
            else
                return true;
        } else {
            if (empty($a))
                return true;
            else
                return false;
        }
    }

    private function callback($value, $callback) {
        $class = controller::get_instance();
        return $class->$callback($value);
    }

    private function equal($value) {
        $a = trim($value);
        if ($a == 'sama')
            return 1;
        else
            return 0;
    }

}

?>
