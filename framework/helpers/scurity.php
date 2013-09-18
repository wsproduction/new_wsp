<?php

class scurity extends helper {
	
    public function __construct() {
        parent::__construct();
    }
    
	public static function page_cache($expires = 'Tue, 01 Jan 2000 00:00:00') {
		header("Expires: {$expires} GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0"); 
		header("Cache-Control: post-check=0, pre-check=0", false); 
		header("Pragma: no-cache");
	}
	
}

?>