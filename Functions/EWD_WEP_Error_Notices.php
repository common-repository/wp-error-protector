<?php
/* Add any update or error notices to the top of the admin page */
function EWD_WEP_Error_Notices(){
    global $ewd_wep_message;
		if (isset($ewd_wep_message)) {
			if (isset($ewd_wep_message['Message_Type']) and $ewd_wep_message['Message_Type'] == "Update") {echo "<div class='updated'><p>" . $ewd_wep_message['Message'] . "</p></div>";}
			if (isset($ewd_wep_message['Message_Type']) and $ewd_wep_message['Message_Type'] == "Error") {echo "<div class='error'><p>" . $ewd_wep_message['Message'] . "</p></div>";}
		}
}

?>