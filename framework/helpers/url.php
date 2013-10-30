<?php

class url extends helper {

    public function __construct() {
        parent::__construct();
    }

    public static function base($uri = '', $ssl = false) {
        $url = parent::$param['base_url'];
        if (!empty($uri))
            $url .= $uri;

        if ($ssl)
            $url = preg_replace("/^http:\/\//", 'https://', $url);

        return $url;
    }

    public static function attachment($uri = '', $ssl = false) {
        $url = parent::$param['application']['attachment']['url'] . '/';
        if (!empty($uri))
            $url .= $uri;

        if ($ssl)
            $url = preg_replace("/^http:\/\//", 'https://', $url);

        return $url;
    }

    public static function anchor($title, $uri = '', $ssl = false, $attribut = array()) {

        $attr = '';
        foreach ($attribut as $key => $value) {
            $attr .= $key .= '="' . $value . '" ';
        }

        if (is_bool($uri) && $uri == false)
            $uri = 'javascript:void(0)';
        else
            $uri = self::base($uri, $ssl);

        $anchor = '<a href="' . $uri . '" ' . $attr . '>' . $title . '</a>';
        return $anchor;
    }

    public static function redirect($uri, $ssl = false) {
        $url = self::base($uri, $ssl);
        header('Location: ' . $url);
    }

}

?>
