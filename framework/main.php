<?php

class WSFramework {

    public static function app($router) {
        require_once('system/core.php');
        return new core($router);
    }

}

?>
