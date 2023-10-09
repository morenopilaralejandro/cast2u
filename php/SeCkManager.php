<?php
require_once __DIR__ . '/class/Video.php';
require_once __DIR__ . '/class/Token.php';
class SeCkManager {
    private int $seIdUsr;
    private string $seConfMsg;
    private string $ckTokenUsr;
    private string $ckLangCode;
    private string $ckError;
    private string $agent;
    private int $ckTime;

    //functions
	public function validateToken(): bool {
        $this->clearCkError();
		if($this->seIdUsr < 0) {
            if(!empty($this->ckTokenUsr)) {
                $tokenObj = Token::factory();;
				$tokenArr = $tokenObj->getTokenByStringToken($this->ckTokenUsr);
                if(count($tokenArr) > 0) {
                    $tokenObj = $tokenArr[0];
                    $this->setSeIdUsr($tokenObj->getIdUsr());
                    return true;
                } else {
                    return false; //redirect index
                }	
            }else{
                return false; //redirect index
		    }
        } else {
            return true;
        }
	}


    public function validateIdVid(int $idVid): bool {
        /*
        Check if exists and the current user is the owner
        */
        $videoObj = Video::factory();
        $videoArr = $videoObj->getVideoByIdVid($idVid);
        if(count($videoArr) > 0) {
            $videoObj = $videoArr[0];
		    if($videoObj->getIdUsr() == $this->seIdUsr) {
			    return true; 
		    }
        }
        return false; 
	}

    public function checkSelectedLang(string $value): string{
	    if($value == $this->ckLangCode) {
		    return " selected ";
	    }else{
            return "";
        }
    }
    
    public function logOut(): void {
        $this->clearCkTokenUsr();
        $this->clearSeIdUsr();
        $this->clearCkError();
    }

    //constructor
    public function __construct() {
        $this->seIdUsr = $_SESSION["seIdUsr"] ?? -1;
        $this->seConfMsg = $_SESSION["seConfMsg"] ?? '';
        $this->ckTokenUsr = $_COOKIE["ckTokenUsr"] ?? '';

        $langCode = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $langCode = substr($langCode, 0, 2);
        $defaultLangCode = 'en';
        switch($langCode) {
            case 'en':
                $defaultLangCode = 'en';
                break;
            case 'es':
                $defaultLangCode = 'es';
                break;
            default: 
                $defaultLangCode = 'en';
                break;    
        }
        $this->ckLangCode = $_COOKIE["ckLangCode"] ?? $defaultLangCode;

        $this->ckError = $_COOKIE["ckError"] ?? '';

	    $usrAg = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($usrAg, "Nintendo Wii") !== false) {
			$this->agent = "wiiu";
		} else if (strpos($usrAg, "Safari") !== false) {
			$this->agent = "safari";
		} else{
			$this->agent = "unset";
		}

        $this->ckTime = 3600 * 24 * 365;
    }

    //setter getter
    public function setSeIdUsr(int $seIdUsr): void { 
        $this->seIdUsr = $seIdUsr; 
        $_SESSION["seIdUsr"]=$seIdUsr;
    }
    public function getSeIdUsr(): int {
        return $this->seIdUsr; 
    }

    public function setSeConfMsg(string $seConfMsg): void { 
        $this->seConfMsg = $seConfMsg; 
        $_SESSION["seConfMsg"]=$seConfMsg;
    }
    public function getSeConfMsg(): string {
        return $this->seIdUsr; 
    }

    public function setCkTokenUsr(string $ckTokenUsr): void { 
        $this->ckTokenUsr = $ckTokenUsr;
        setcookie("ckTokenUsr", $ckTokenUsr, time()+$this->ckTime, "/"); 
    }
    public function getCkTokenUsr(): string { 
        return $this->ckTokenUsr; 
    }

    public function setCkLangCode(string $ckLangCode): void { 
        $this->ckLangCode = $ckLangCode; 
        setcookie("ckLangCode", $ckLangCode, time()+$this->ckTime, "/");
    }
    public function getCkLangCode():string { 
        return $this->ckLangCode; 
    }

    public function setCkError(string $ckError): void { 
        $this->ckError = $ckError; 
        setcookie("ckError", $ckError, time()+$this->ckTime, "/");
    }
    public function getCkError(): string {
        return $this->ckError; 
    }

    public function setAgent(string $agent): void { 
        $this->agent = $agent; 
    }
    public function getAgent(): string {
        return $this->agent; 
    }

    public function setCkTime(int $ckTime): void {
        $this->ckTime = $ckTime; 
    }
    public function getCkTime(): int { 
        return $this->ckTime; 
    }
    
    //clear
    public function clearSeIdUsr(): void { 
        unset($_SESSION['seIdUsr']);
    }

    public function clearCkTokenUsr(): void { 
        unset($_COOKIE['ckTokenUsr']);
        setcookie('ckTokenUsr', '', -1, '/');
    }

    public function clearCkLangCode(): void { 
        unset($_COOKIE['ckLangCode']);
        setcookie('ckLangCode', '', -1, '/');
    }

    public function clearCkError(): void { 
        unset($_COOKIE['ckError']);
        setcookie('ckError', '', -1, '/');
    }
}
?>
