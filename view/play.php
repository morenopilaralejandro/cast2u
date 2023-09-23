<?php
	session_start();
    $_SESSION["seIdUsr"]=1;

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
                $agent = $manager->detectUserAgent();
                $videoObj = Video::Factory();
                $videoObj = $videoObj->getVideoByIdVid($idVid)[0];
                header("Location: {$videoObj->getUrl()}");
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
<!doctype html>
<html lang="<?=$manager->getCkLangCode()?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<title><?=$strTitle00?></title>
	<meta name="description" content="<?=$strDescription?>">
	<meta name="author" content="<?=$strAuthor?>">

	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">

	<link rel="stylesheet" href="../css/general.css">
</head>

<body class="viewIframe" >
	<header style="visibility:hidden;">&nbsp;</header>
	
	<div id="container">
        &nbsp;
	</div>			
	
	<footer style="visibility:hidden;">&nbsp;</footer>
</body>
</html>

