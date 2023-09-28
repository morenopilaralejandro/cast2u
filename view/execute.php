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
			case "insert_vid":
                if($manager->validateToken()) {
                    $idVid = $_POST['id_vid'];
                    $title = $_POST['title'];
                    $img = $_POST['img'];
                    $url = $_POST['url'];
                    $counterEnabled = $_POST['ck_counter'] ?? false;
                    $counterValue = $_POST['value_counter'] ?? 0;
                    $orderValue = 0;

                    if(empty($img)) {
                        $img = "../img/def_thumb.jpg";
                    }
                    
                    if(strlen($title) < 32 &&
                        strlen($img) < 2000 &&
                        strlen($url) < 2000 &&
                        $counterValue < 1000) {

                        if($queryType == "insert_vid") {
                            $idUsr = $manager->getSeIdUsr();
                            $videoArr = $videoObj->getVideoByIdUsr($idUsr);
                            $orderValue = count($videoArr);

                            $videoObj->insert(0, $url, $img, $title, '', 
                                $counterEnabled, $counterValue, 
                                $orderValue, $idUsr);
                            header('Location: panel.php');
                        } else {
                            if($queryType == "update_vid") {
                                if($manager->validateIdVid($idVid)){
                                    $videoObj = $videoObj->getVideoByIdVid($idVid)[0];
                                    $videoObj->setTitle($title);
                                    $videoObj->setImg($img);
                                    $videoObj->setUrl($url);
                                    $videoObj->setUploadDate(date("Y-m-d"));        
                                    $videoObj->setCounterEnabled($counterEnabled);
                                    $videoObj->setCounterValue($counterValue);
                                    header('Location: panel.php');
                                } else {
                                    header('Location: panel.php');
                                }

                            } else {
                                header('Location: panel.php');
                            }
                        }
                    } else {
                        header('Location: panel.php');
                    }
                } else {
                    header('Location: ../index.php');
                }
				break;
			case "save_settings":
                if($manager->validateToken()) {
                    $manager->setCkLangCode($_POST["selectLang"]);
				    header('Location: panel.php');   
                } else {
                    header('Location: panel.php');
                }
				break;
			case "delete_user":
                if($manager->validateToken()) {
                    $idUsr = $manager->getSeIdUsr();
                    
                    $videoObj = $videoObj->getVideoByIdUsr($idUsr);
                    foreach($videoObj as $i) {
                        $i->delete();
                    } 

                    $tokenObj = $tokenObj->getTokenByIdUsr($idUsr)[0];
                    $tokenObj->delete();

                    $usrObj = $usrObj->getUsrByIdUsr($idUsr)[0];
                    $usrObj->delete(); 
 
                    $manager->logOut();
                }
                header('Location: ../index.php');
				break;
			default:
       			header('Location: ../index.php');
		}
	}else{
		header('Location: ../index.php');
	}
?>
