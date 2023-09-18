<?php 
	session_start();
	include_once "../php/funDb.php";
	
	function validateCookie($bd, $option) {
        clearError();
		if(!isset($_SESSION["seIdUsr"])) {
			if(isset($_COOKIE["ckTokenUsr"])) {
				$token = $_COOKIE["ckTokenUsr"];
				$resulIdUsr = verifyToken($token, $bd);
                
				if($resulIdUsr>0){
				    $_SESSION["seIdUsr"]=$resulIdUsr;
                    return $_SESSION["seIdUsr"];
		
				}else{
					header('Location: ../index.php');
		        }	
		    }else{
		        header('Location: ../index.php');
		    }
		}else{
			return $_SESSION["seIdUsr"];
		}
	}

	function validateVidId()
	{
        //TODO
        //if ->idUsr == seIdUsr
		if(isset($_GET["vid"])){
			return true; 
		}else{
			return false;
		}
	}

    function storeDbToken($db) {
        $ckTime = 3600 * 24 * 365;
        $token= getTokenById($_SESSION["seIdUsr"], $db);
        $token= $token[0]->string_token;
        setcookie("ckTokenUsr", $token, time()+$ckTime, "/");
    }
    
    function generateToken($option, $db) {
        $ckTime = 3600 * 24 * 365;
        $used= 1;
        while($used==1){
            $token= bin2hex(random_bytes(16));    
            switch ($option) {
			    case 0:
				    $used=insertToken($token, $_SESSION["seIdUsr"], $db);
				    break;
			    case 1:
				    $used=updateToken($token, $_SESSION["seIdUsr"], $db);
				    break;
		    } 

        } 
        setcookie("ckTokenUsr", $token, time()+$ckTime, "/");
    }

    function logOut(){
        if (isset($_COOKIE['ckTokenUsr'])) {
            unset($_COOKIE['ckTokenUsr']);
            setcookie('ckTokenUsr', null, -1, '/');
        }
        if (isset($_SESSION['seIdUsr'])) {
            unset($_SESSION['seIdUsr']);
        }
        if (isset($_COOKIE['ckError'])) {
            unset($_COOKIE['ckError']);
            setcookie('ckError', null, -1, '/');
        }
    }

    //TODO
    cambiar por sesion
    function setCkError($errMsg){
        $ckTime = 120;
        setcookie("ckError", $errMsg, time()+$ckTime, "/");
    }
    
    function clearCkError() {
         if (isset($_COOKIE['ckError'])) {
            unset($_COOKIE['ckError']);
            setcookie('ckError', null, -1, '/');
        }
    }

    function getCkError(){
        if (isset($_COOKIE['ckError'])) {
            return $_COOKIE['ckError'];
        }else{
            return "&nbsp;";        
        }
    }

?> 
