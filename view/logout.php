<?php
	session_start();

    require_once __DIR__ . '/../php/SeCkManager.php';
    require_once __DIR__ . '/../php/class/Video.php';
    require_once __DIR__ . '/../php/class/Usr.php';
    
    $manager = new SeCkManager();
    if($manager->validateToken()) {
        $manager->logOut();
    }
    header('Location: ../index.php');
?>
