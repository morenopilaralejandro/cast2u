<?php
	session_start();
    require_once __DIR__ . '/../php/SeCkManager.php';
    require_once __DIR__ . '/../php/WebComp.php';
    require_once __DIR__ . '/../php/class/Video.php';
    require_once __DIR__ . '/../php/class/Usr.php';
    require_once __DIR__ . '/../php/class/Token.php';

    $manager = new SeCkManager();
    $webComp = new WebComp($manager->getCkLangCode());
    include __DIR__ . $webComp->getLangFile();
    $usrObj = Usr::factory();
    $videoObj = Video::factory();
    $tokenObj = Token::factory();
	
	if(isset($_POST["queryType"])){
        $queryType = $_POST["queryType"];
		switch ($queryType) {
			case "insert_user":
                $email = $_POST["email"];
                $usrName = $_POST["username"];
				$pass = $_POST["pass"];
                $passEnc = md5($_POST["pass"]);
				$pass2 = $_POST["pass2"];
                if(strlen($usrName) < 32 && strlen($pass) < 32 
                        && strlen($pass2) < 32  && strlen($email) < 120) {
				    if(strlen($pass) > 4) {
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            if($pass == $pass2) {
                                $usrArr1 = $usrObj->getUsrByName($usrName);
                                $usrArr2 = $usrObj->getUsrByEmail($email);
                                if(count($usrArr1) == 0) {
                                    if(count($usrArr2) == 0) {
                                        $usrObj->insert(0, $usrName, $passEnc, $email);
                                        $usrObj = $usrObj->getUsrByEmail($email)[0];
                                        $idUsr = $usrObj->getIdUsr();                
                                        
                                        $tokenString = $tokenObj->generateUniqueToken();
                                        $tokenObj->insert(0, $tokenString, '', $idUsr);
                                        
                                        $manager->setSeIdUsr($idUsr);
                                        $manager->setCkTokenUsr($tokenString);
                                        header('Location: panel.php');
                                    } else {
                                        $manager->setCkError($strError5);
                                        header('Location: register.php');
                                    } 
                                } else {
                                    $manager->setCkError($strError4);
                                    header('Location: register.php');
                                }    
                            } else {
                                $manager->setCkError($strError3);
                                header('Location: register.php');
                            }
                        } else {
                            $manager->setCkError($strError2);
                            header('Location: register.php');
                        }
				    } else {
                        $manager->setCkError($strError2);
                        header('Location: register.php');
                    }
                } else {
                    $manager->setCkError($strError2);
                    header('Location: register.php');
                }
				break;
			case "login_user":
                $email = $_POST["email"];
				$pass = $_POST["pass"];
                $passEnc = md5($_POST["pass"]);
                if(strlen($pass) < 32 && strlen($email) < 120) {
				    if(strlen($pass) > 4) {
                        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					        $usrArr = $usrObj->getUsrByEmail($email);
					        if(count($usrArr) > 0){
                                $usrObj = $usrArr[0];
						        if($usrObj->getPwd() == $passEnc){
                                    $manager->setSeIdUsr($usrObj->getIdUsr());
                                    $idUsr = $usrObj->getIdUsr();
                                    $tokenObj =  $tokenObj->getTokenByIdUsr($idUsr)[0];
                                    $tokenString = $tokenObj->getStringToken();
                                    $manager->setCkTokenUsr($tokenString);
							        header('Location: list.php');
						        } else {
                                    $manager->setCkError($strError2);
                                    header('Location: login.php');
                                }
					        } else {
                                $manager->setCkError($strError2);
                                header('Location: login.php');
                            }	
                        } else {
                            $manager->setCkError($strError2);
                            header('Location: login.php');
                        }
				    } else {
                        $manager->setCkError($strError2);
                        header('Location: login.php');
                    }
                } else {
                    $manager->setCkError($strError2);
                    header('Location: login.php');
                }
				break;
			case "update_vid":
				$idUsr=validateCookie($bd,0);
				$id_vid = $_POST["id_vid"];
				$url = $_POST["url"];
				$img = $_POST["img"];
				$title = $_POST["title"];
				$result = updateVid($id_vid, $title, $img, $url, $idUsr, $bd);
				header('Location: panel.php');
				break;
			case "insert_vid":
				$idUsr=validateCookie($bd,0);
				$url = $_POST["url"];
				$img = $_POST["img"];
				$title = $_POST["title"];
				$result = insertVid($url, $img,$title, $idUsr, $bd);
				header('Location: panel.php');
				break;
			case "del_vid":
				$idUsr=validateCookie($bd,0);
				$id_vid = $_POST["id_vid"];
				$result = deleteVid($id_vid, $idUsr, $bd);
				header('Location: panel.php');
				break;
			case "save_settings":
                setLang();
				header('Location: panel.php');            
				break;
			case "delete_user":
                $idUsr=validateCookie($bd,0);
                $result = deleteUsr($idUsr, $bd);
                logOut();
                $_SESSION["sesConfMsg"]= $stConf1;
                header('Location: confirm.php');
				break;
			default:
       			header('Location: ../index.php');
		}
	}else{
		header('Location: ../index.php');
	}
?>
