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

    public static function modul($data) {
        // Parsing Menu
        $modul = '';
        $menu = array();
        $order = array();
        foreach ($data->objects() as $row) {
            $status = '';
            if ($row->modul_url == $modul)
                $status = 'active';

            if (empty($row->modul_parent)) {
                $order['parent'][$row->modul_order] = $row->modul_id;
                $menu['parent'][$row->modul_id] = array(
                    'title' => $row->modul_name,
                    'url' => $row->modul_url,
                    'description' => $row->modul_description,
                    'status' => $status,
                    'icon' => $row->modul_icon
                );
            } else {
                $order['children'][$row->modul_parent][$row->modul_order] = $row->modul_id;

                if ($status == 'active')
                    $menu['parent'][$row->modul_parent]['status'] = $status;

                $menu['children'][$row->modul_parent][$row->modul_id] = array(
                    'title' => $row->modul_name,
                    'url' => $row->modul_url,
                    'description' => $row->modul_description,
                    'status' => $status,
                    'icon' => $row->modul_icon
                );
            }
        }

        // Render Menu
        ksort($order['parent']);
        $m = '';
        foreach ($order['parent'] as $key => $val) {
            $data = $menu["parent"][$val];
            $url = '';//($data['url'] != '#') ? base_url($data['url']) : '#';

            // Validate Menu
            $class = '';
            $m2 = '';
            if (isset($order['children'][$val])) {
                $class .= 'dropdown';

                if ($data['status'] == 'active')
                    $m2 .= '<ul  class="dropdown-menu">';
                else
                    $m2 .= '<ul class="dropdown-menu">';

                // Render Anak Menu
                ksort($order['children'][$val]);
                foreach ($order['children'][$val] as $key2 => $val2) {
                    if (isset($menu["children"][$val][$val2])) {
                        $data2 = $menu["children"][$val][$val2];
                        $url2 = '';//($data2['url'] != '#') ? base_url($data2['url']) : '#';

                        $m2 .= '<li><a href="' . $url2 . '"> ' . $data2['title'] . '</a></li>';
                    }
                }

                $m2 .= '</ul>';
            }

            $class .= ' ' . $data['status'];

            // View Menu
            $m .= '<li>';
            $m .= '<a data-toggle="dropdown" class="dropdown-toggle" href="' . $url . '">' . $data['title'] . '<span class="caret"></span></a>';
            $m .= $m2;
            $m .= '</li>';
        }
        $m .= '';
        return $m;
    }

}

?>
