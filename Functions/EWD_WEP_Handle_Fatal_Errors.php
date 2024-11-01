<?php
$Selected_Errors = get_option("EWD_WEP_Selected_Errors");
if (!is_array($Selected_Errors)) {$Selected_Errors = array();}

if (in_array("E_ERROR", $Selected_Errors)) {register_shutdown_function( "EWD_WEP_Handle_Fatal_Errors" );}
function EWD_WEP_Handle_Fatal_Errors() {
	$Selected_Errors = get_option("EWD_WEP_Selected_Errors");
	if (!is_array($Selected_Errors)) {$Selected_Errors = array();}
	
	foreach ($Selected_Errors as $key => $Error) {
		$Selected_Errors[$key] = constant($Error);
	}

	$error = error_get_last();
	
	if( $error !== NULL) {
	  $errno = $error["type"];
	  $errfile = $error["file"];
	}
	else {
		$errfile = "";
		$errno = "";
	}

	// Treat a parse error as a fatal error
	if ($errno == E_PARSE) {$errno = E_ERROR;}
	if ($errno == E_ERROR and in_array($errno, $Selected_Errors)) {
		EWD_WEP_Process_Error_Handling($errfile, $error['message'], $error['line'], $error['type']);
	}

	return true;	
}

?>