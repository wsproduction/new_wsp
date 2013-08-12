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
    private $validation_list = array('requaired' => 'is Requaired');

    public function __construct($param) {
        $this->param = $param;
    }

    public function post($variable_name = '', $validation = '') {
        $res = null;
        if (isset($_POST[$variable_name])) {
            $temp_value = $_POST[$variable_name];
            if (!is_array($temp_value)) {
                $val = trim($temp_value);
                if ($val != '') {
                    $res = $val;
                }
            } else {
                $res = $val;
            }
        }

        $this->value[$variable_name] = $res;
        if (!empty($validation)) {
            $this->validation[$variable_name] = $validation;
        }

        return $res;
    }

    public function get($variable_name = '', $default_value = NULL) {
        if (isset($_GET[$variable_name])) {
            $temp_val = $_GET[$variable_name];
            if (!is_array($temp_val)) {
                $val = trim($temp_val);
                $res = $default_value;
                if ($val != '') {
                    $res = $val;
                }
            } else {
                $res = $val;
            }
            return $res;
        } else {
            return $default_value;
        }
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

    public function validation() {

        $error = 0;
        if (count($this->validation)) {
            foreach ($this->validation as $key => $a) {

                $rules = explode('|', $a);
                foreach ($rules as $b) {
                    if (preg_match('/^title/', $b)) {
                        $c = explode('[', $b);
                        $this->message[$key]['title'] = $this->get_parameter($c[1]);
                    } else {
                        if (isset($this->validation_list[$b])) {
                            if (!$this->$b($this->value[$key])) {
                                $error++;
                                $status = false;
                            } else {
                                $status = true;
                            }
                            $this->set_status($key, $b, $status);
                        }
                    }
                }
            }
        }

        if ($error == 0)
            return true;
        else
            return false;
    }

    private function set_status($key, $validation, $status) {
        $this->message[$key]['status'][$validation] = $status;
    }

    private function get_parameter($string) {
        $param = str_replace("]", '', $string);
        return $param;
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
                            $show_message .= '<div>' . $title . ' ' . $default_message . '</div>';
                            break;
                        }
                    }
                }
            }
        }
        return $show_message;
    }

    /* Daftar Fungsi Validasi input */

    private function requaired($value) {
        $a = trim($value);
        if (!empty($a))
            return true;
        else
            return false;
    }

    private function equal($value) {
        $a = trim($value);
        if ($a == 'sama')
            return true;
        else
            return false;
    }

}

?>
