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

class mymenu extends helper {

    public function __construct() {
        parent::__construct();
    }

    private static $menu = array();
    private static $order = array();

    public static function modul($data) {
        // Parsing Menu
        foreach ($data->objects() as $row) {
            if (empty($row->modul_parent)) {
                self::$order['parent'][$row->modul_order] = $row->modul_id;
                self::$menu['parent'][$row->modul_id] = array(
                    'title' => $row->modul_name,
                    'url' => $row->modul_url,
                    'description' => $row->modul_description,
                    'icon' => $row->modul_icon
                );
            } else {
                self::$order['children'][$row->modul_parent][$row->modul_order] = $row->modul_id;

                self::$menu['children'][$row->modul_parent][$row->modul_id] = array(
                    'title' => $row->modul_name,
                    'url' => $row->modul_url,
                    'description' => $row->modul_description,
                    'icon' => $row->modul_icon
                );
            }
        }

        // Render Menu
        ksort(self::$order['parent']);
        $m = '';
        foreach (self::$order['parent'] as $val) {
            $data = self::$menu["parent"][$val];
            $url = $data['url'];
            $title = $data['title'];

            // View Menu
            $m .= '<li>';
            if (isset(self::$order['children'][$val])) {
                $m .= '     <a data-toggle="dropdown" class="dropdown-toggle" href="' . $url . '">' . $title . '<span class="caret"></span></a>';
                $m .= self::child_modul($val);
            } else {
                $m .= '     <a href="' . $url . '">' . $title . '</a>';
            }
            $m .= '</li>';
        }
        $m .= '';
        return $m;
    }

    private static function child_modul($val) {
        $m = '';
        $m .= '<ul class="dropdown-menu">';

        // Render Anak Menu
        ksort(self::$order['children'][$val]);
        foreach (self::$order['children'][$val] as $val2) {
            if (isset(self::$menu["children"][$val][$val2])) {
                $data = self::$menu["children"][$val][$val2];
                $url = $data['url'];
                $title = $data['title'];

                if (isset(self::$order['children'][$val2])) {
                    $m .= '<li class="dropdown-submenu">';

                    $taget = '';
                    if ($url == '#') {
                        $taget = 'data-toggle="dropdown" class="dropdown-toggle"';
                    }

                    $m .= ' <a ' . $taget . ' href="' . $url . '"> ' . $title . '</a>';
                    $m .= self::child_modul($val2);
                    $m .= '</li>';
                } else {
                    $m .= '<li>';
                    $m .= ' <a href="' . $url . '"> ' . $title . '</a>';
                    $m .= '</li>';
                }
            }
        }

        $m .= '</ul>';

        return $m;
    }

}

?>
