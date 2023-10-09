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
        $idVid = $_GET["v"];
        $idUsr = $manager->getSeIdUsr();
        if($manager->validateIdVid($idVid)) {
            $videoObj = Video::Factory();
            $videoObj = $videoObj->getVideoByIdVid($idVid)[0];
            $videoArr = $videoObj->getVideoByIdUsr($idUsr);
            foreach($videoArr as $i) {
                if($i->getOrderValue() > $videoObj->getOrderValue()) {
                    $i->setOrderValue($i->getOrderValue()-1);
                }
            }
            $videoObj->delete();
            header('Location: panel.php');
        } else {
            header('Location: panel.php');
        }
    } else {
        header('Location: panel.php');
    }
?>
