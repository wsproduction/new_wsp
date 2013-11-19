<?php

class form extends helper {

    private static $attribut;
    private static $validation_status;
    private static $form_validation;
    private static $form_id;
    private static $form_tips_id;
    private static $password_meter;
    private static $password_meter_id;
    private static $form_options;
    private static $type_allowed = array('button', 'checkbox', 'file', 'hidden', 'image',
        'password', 'radio', 'reset', 'submit', 'text',
        'textarea', 'label', 'fieldset', 'select', 'optgroup');

    public function __construct() {
        parent::__construct();
    }

    public static function begin($name = '', $action = '', $method = 'get', $attribut = array()) {
        $attr = self::parsing_attribut($attribut);
        self::$form_id = $name;
        return '<form id="' . $name . '" name="' . $name . '" action="' . $action . '" method="' . $method . '" ' . $attr . '>';
    }

    public static function end() {
        $form = '</form>';
        $form .= '<script type="text/javascript">';
        $form .= '$(function(){';
        $form .= self::parsing_tips(self::$form_tips_id);
        $form .= self::parsing_validation(self::$form_id, self::$form_validation);
        $form .= self::parsing_input_type(__input_type::$list);
        $form .= self::parsing_password_meter(self::$password_meter_id);
        $form .= '});';
        $form .= '</script>';
        return $form;
    }

    private static function reset_attribut() {
        self::$attribut = array();
        self::$form_options['list'] = array();
        self::$form_options['selected'] = '';
    }

    public static function create($type, $name, $attribut = array(), $render = false) {
        self::reset_attribut();
        self::$attribut['type'] = $type;
        self::$attribut['name'] = $name;
        self::push_attribut($attribut);

        if ($render)
            return self::generate();
    }

    public static function value($value) {
        self::$attribut['value'] = $value;
    }

    public static function options($list = array(), $value = '') {
        self::$form_options['list'] = $list;
        self::$form_options['selected'] = $value;
    }

    private static function generate() {
        $form = '';
        $type = self::$attribut['type'];

        if (in_array($type, self::$type_allowed)) {
            $attr = self::parsing_attribut(self::$attribut);
            if (in_array($type, array('select', 'optgroup'))) {
                $form .= '<select ' . $attr . ' />';

                if ($type == 'select') {
                    foreach (self::$form_options['list'] as $key => $val) {
                        $selected = '';
                        if ($key == self::$form_options['selected'])
                            $selected = 'selected="selected"';
                        $form .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
                    }
                } else {
                    foreach (self::$form_options['list'] as $label => $option) {
                        $form .= '<optgroup>' . $label . '</option>';
                        foreach ($option as $key => $val) {
                            $selected = '';
                            if ($key == self::$form_options['selected'])
                                $selected = 'selected="selected"';
                            $form .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
                        }
                    }
                }

                $form .= '</select>';
            } else if (in_array($type, array('textarea'))) { 
                $form .= '<textarea ' . $attr . ' ></textarea>';
            } else {
                $form .= '<input ' . $attr . ' />';
            }


            // validation
            if (self::$validation_status) {

                $type = __validation::$type;
                $msg = __validation::$msg;
                $remote = __validation::$remote;

                if (!empty($type)) {
                    // config validation
                    self::$form_validation[self::$attribut['name']] = self::parsing_validation_properties($type, $msg, $remote);
                }
            }
        } else {
            $form = 'Form dengan type <b> ' . $type . '</b> tidak ditemukan.';
        }
        self::$validation_status = false;
        return $form;
    }

    public static function tips($tips) {
        if (isset($tips)) {
            self::$attribut['tips'] = $tips;
            self::$form_tips_id[] = self::$attribut['name'];
        }
    }

    public static function password_meter($status = 'false') {
        self::$password_meter = $status;
    }

    public static function validation() {
        self::$validation_status = true;
        return new __validation();
    }

    public static function input_type() {
        return new __input_type(self::$frmName);
    }

    public static function render() {
        return self::generate();
    }

    public static function label($title = '', $for = '', $attr = array()) {
        $atrib = $attr;
        if (is_array($attr)) {
            $atrib = self::parsing_attribut($attr);
        }
        $label = '<label for="' . $for . '" ' . $atrib . '>' . $title . '</label>';
        return $label;
    }

    private static function parsing_attribut($array) {
        $attr = '';
        if (is_array($array)) {
            foreach ($array as $key => $val) {
                $attr .= $key . '="' . $val . '" ';
            }
        }
        return $attr;
    }

    private static function push_attribut($array) {
        if (is_array($array)) {
            foreach ($array as $key => $val) {
                self::$attribut[$key] = $val;
            }
        }
    }

    private static function parsing_validation_properties($type = array(), $msg = array(), $remote = array()) {
        $properties = '';

        if (!empty($type)) {
            $count = count($type);
            $idx = 1;
            foreach ($type as $value) {
                $properties .= $value;
                if ($idx < $count) {
                    $properties .= ',';
                }
                $idx++;
            }
        }

        if (!empty($msg)) {
            $properties .= ', messages : {';
            $count = count($msg);
            $idx = 1;
            foreach ($msg as $value) {
                $properties .= $value;
                if ($idx < $count) {
                    $properties .= ',';
                }
                $idx++;
            }
            $properties .= '}';
        }

        if (!empty($remote)) {
            $properties .= ', remote : {';
            $count = count($remote);
            $idx = 1;
            foreach ($remote as $key => $value) {
                if ($key == 'data') {
                    $properties .= $key . ' : ' . $value;
                } else {
                    $properties .= $key . ' : "' . $value . '"';
                }

                if ($idx < $count) {
                    $properties .= ',';
                }
                $idx++;
            }
            $properties .= '}';
        }

        return $properties;
    }

    private static function parsing_tips($param = array()) {
        $other = '';
        if (isset($param)) {
            foreach ($param as $value) {
                $other .= 'form_tips("' . $value . '");';
            }
        }
        return $other;
    }

    private static function parsing_validation($form_name, $param = array()) {
        $val = '';
        if (!empty($param)) {
            $val .= '$("#' . $form_name . '").validate();';
            foreach ($param as $key => $value) {
                $val .= '$("#' . $form_name . ' #' . $key . '").rules("add",';
                $val .= '{ ' . $value . ' }';
                $val .= ');';
            }
        }

        return $val;
    }

    private static function parsing_input_type($param = array()) {
        $val = '';
        if (!empty($param)) {
            foreach ($param as $value) {
                $val .= $value;
            }
        }

        return $val;
    }

    public static function parsing_password_meter($param = array()) {
        $val = '';
        if (!empty($param)) {
            foreach ($param as $value) {
                $val .= '$("#' . $value . '").pwdMeter({outputID:"#pm_' . $value . '"});';
            }
        }

        return $val;
    }

}

/* Class form validation */

class __validation {

    public static $type = array();
    public static $msg = array();
    public static $remote = array();

    function __construct() {
        
    }

    public function requaired($message = null) {
        self::$type[] = 'required : true';
        if (isset($message)) {
            self::$msg[] = 'required : "' . $message . '"';
        }
    }

    public function number($message = null) {
        self::$type[] = 'number : true';
        if (isset($message)) {
            self::$msg[] = 'number : "' . $message . '"';
        }
    }

    public function email($message = null) {
        self::$type[] = 'email : true';
        if (isset($message)) {
            self::$msg[] = 'email : "' . $message . '"';
        }
    }

    public function equal_to($equalTo = null, $message = null) {
        self::$type[] = 'equalTo : "' . $equalTo . '"';
        if (isset($message)) {
            self::$msg[] = 'equalTo : "' . $message . '"';
        }
    }

    public function min_length($length = null, $message = null) {
        self::$type[] = 'minlength : ' . $length;
        if (isset($message)) {
            self::$msg[] = 'minlength : "' . $message . '"';
        }
    }

    public function max_length($length = null, $message = null) {
        self::$type[] = 'maxlength : ' . $length;
        if (isset($message)) {
            self::$msg[] = 'maxlength : "' . $message . '"';
        }
    }

    public function range_length($minLength = null, $maxLength = null, $message = null) {
        self::$type[] = 'rangelength : [' . $minLength . ',' . $maxLength . ']';
        if (isset($message)) {
            self::$msg[] = 'rangelength : "' . $message . '"';
        }
    }

    public function min($number = null, $message = null) {
        self::$type[] = 'min : ' . $number;
        if (isset($message)) {
            self::$msg[] = 'min : "' . $message . '"';
        }
    }

    public function max($number = null, $message = null) {
        self::$type[] = 'max : ' . $number;
        if (isset($message)) {
            self::$msg[] = 'max : "' . $message . '"';
        }
    }

    public function range($minNumber = null, $maxNumber = null, $message = null) {
        self::$type[] = 'range : [' . $minNumber . ',' . $maxNumber . ']';
        if (isset($message)) {
            self::$msg[] = 'range : "' . $message . '"';
        }
    }

    public function url($message = null) {
        self::$type[] = 'url : true';
        if (isset($message)) {
            self::$msg[] = 'url : "' . $message . '"';
        }
    }

    public function accept($extensions = null, $message = null) {
        self::$type[] = 'accept : "' . $extensions . '"';
        if (isset($message)) {
            self::$msg[] = 'accept : "' . $message . '"';
        }
    }

    public function larger_date_from($comparison = null, $message = null) {
        self::$type[] = 'largerDateFrom : "' . $comparison . '"';
        if (isset($message)) {
            self::$msg[] = 'largerDateFrom : "' . $message . '"';
        }
    }

    public function smaller_date_from($comparison = null, $message = null) {
        self::$type[] = 'smallerDateFrom : "' . $comparison . '"';
        if (isset($message)) {
            self::$msg[] = 'smallerDateFrom : "' . $message . '"';
        }
    }

    public function remote($url = null, $type = null, $data = array()) {
        isset($url) ? self::$remote['url'] = $url : null;
        isset($type) ? self::$remote['type'] = $type : null;

        if (!empty($data)) {
            if (is_array($data)) {
                $d = '{ ';
                $count = count($data);
                $idx = 1;
                foreach ($data as $key => $value) {
                    if (preg_match("/^#[A-Z,a-z,0-9]/", $value)) {
                        $d .= $key . ': function(){return $("' . $value . '").val();}';
                    } else {
                        $d .= $key . ': "' . $value . '"';
                    }

                    if ($idx < $count) {
                        $d .= ',';
                    }
                    $idx++;
                }
                $d .= '}';

                self::$remote['data'] = $d;
            }
        }
    }

    public static function reset() {
        self::$type = array();
        self::$msg = array();
        self::$remote = array();
    }

}

class __input_type {

    public static $input_type_id;
    public static $list;

    function __construct($id) {
        self::$input_type_id = $id;
    }

    public function alpha_numeric($allow = null) {
        if (isset($allow)) {
            self::$list[] = '$("#' . self::$input_type_id . '").alphanumeric({allow: "' . $allow . '"});';
        } else {
            self::$list[] = '$("#' . self::$input_type_id . '").alphanumeric();';
        }
    }

    public function numeric($allow = null) {
        if (isset($allow)) {
            self::$list[] = '$("#' . self::$input_type_id . '").numeric({allow: "' . $allow . '"});';
        } else {
            self::$list[] = '$("#' . self::$input_type_id . '").numeric();';
        }
    }

    public function alpha($nocaps = false) {
        if ($nocaps) {
            self::$list[] = '$("#' . self::$input_type_id . '").alpha({nocaps: ' . $nocaps . '});';
        } else {
            self::$list[] = '$("#' . self::$input_type_id . '").alpha();';
        }
    }

    public function prevent($char = null) {
        self::$list[] = '$("#' . self::$input_type_id . '").alphanumeric({ichars: "' . $char . '"});';
    }

}

?>
