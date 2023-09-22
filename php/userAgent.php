<?php 
    //TODO merge with ck se manager
	function detectUserAgent() {
		$sUsrAg = $_SERVER['HTTP_USER_AGENT'];
		$browser = "unset";
		if(strpos($sUsrAg, "Nintendo Wii") !== false) {
			$browser = "wiiu";
		} else if (strpos($sUsrAg, "Safari") !== false) {
			$browser = "safari";
		} else{
			$browser = "unset";
		}
		return $browser;	
	}

?>
