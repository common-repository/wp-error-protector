<?php
$Selected_Errors = get_option("EWD_WEP_Selected_Errors");
if (!is_array($Selected_Errors)) {$Selected_Errors = array();} 

if (in_array("E_WARNING", $Selected_Errors) or in_array("E_NOTICE", $Selected_Errors)) {set_error_handler('EWD_WEP_Handle_Lesser_Errors');}
function EWD_WEP_Handle_Lesser_Errors($errno, $errstr, $errfile, $errline) {
    $Selected_Errors = get_option("EWD_WEP_Selected_Errors");
    if (!is_array($Selected_Errors)) {$Selected_Errors = array();}

    foreach ($Selected_Errors as $key => $Error) {
		$Selected_Errors[$key] = constant($Error);
	}
    
    $err = error_get_last(); 
    if ($err) {
        if (in_array($err['type'], $Selected_Errors)) {
            EWD_WEP_Process_Error_Handling($err["file"], $err['message'], $error['line'], $error['type']);
        }
    }
    
    return false;
}

?>