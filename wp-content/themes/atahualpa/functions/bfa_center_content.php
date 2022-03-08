<?php

function bfa_center($center_content) {

global $bfa_ata;

// PHP 
// not for WPMU
if ( !file_exists(ABSPATH."/wpmu-settings.php") ) {
	
	if ( strpos($center_content,'<?php ') !== FALSE ) {
		ob_start(); 
			eval('?>'.$center_content); 
			$center_content = ob_get_contents(); 
		ob_end_clean();
	}
	
}

echo $center_content;

}
?>