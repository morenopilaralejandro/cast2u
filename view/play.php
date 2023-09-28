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
                $url = $videoObj->getUrl();
                $counterEnabled = $videoObj->getCounterEnabled();
                $counterValue = $videoObj->getCounterValue();
                if($counterEnabled) {
                    $url = str_replace("<<counter>>", $counterValue, $url);
                    $videoObj->setCounterValue($counterValue+1);
                }
                header("Location: {$url}");
            }else {
                header('Location: list.php');
            }
        }else {
            header('Location: list.php');
        }
    } else {
		header('Location: ../index.php');
    }
?>
