<?php
	session_start();

    require_once __DIR__ . '/../php/SeCkManager.php';
    require_once __DIR__ . '/../php/WebComp.php';
    require_once __DIR__ . '/../php/class/Video.php';
    require_once __DIR__ . '/../php/class/Usr.php';
    
    $manager = new SeCkManager();
    $webComp = new WebComp($manager->getCkLangCode());
    include __DIR__ . $webComp->getLangFile();

    if($manager->validateToken()) {
        if(isset($_GET['v'])) {
            $idVid =  $_GET['v'];
            if($manager->validateIdVid($idVid)) {
                $agent = $manager->getAgent();
                $videoObj = Video::Factory();
                $videoObj = $videoObj->getVideoByIdVid($idVid)[0];
                $videoArr = $videoObj->getVideoByIdUsr($manager->getSeIdUsr());
                if($videoObj->getOrderValue() > 0) {
                    for($i = 0; $i<count($videoArr); $i++) {
                        $videoAux = $videoArr[$i];
                        /*print_r("
                            {$videoAux->getTitle()} {$videoAux->getOrderValue()}
                            <br>
                        ");*/
                        if($i == $videoObj->getOrderValue()) {
                            $videoAux->setOrderValue($i-1);
                        }
                        if($i == $videoObj->getOrderValue()-1) {
                            $videoAux->setOrderValue($i+1);
                        }
                    }
                    header('Location: panel.php');
                }
            }else {
                header('Location: panel.php');
            }
        }else {
            header('Location: panel.php');
        }
    } else {
		header('Location: ../index.php');
    }
?>
