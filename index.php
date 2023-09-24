<?php 
	session_start();
    require_once __DIR__ . '/php/SeCkManager.php';
    require_once __DIR__ . '/php/WebComp.php';
    require_once __DIR__ . '/php/class/Video.php';
    require_once __DIR__ . '/php/class/Usr.php';
    
    $manager = new SeCkManager();
    $webComp = new WebComp($manager->getCkLangCode());
    include __DIR__ . "/php/lang/{$manager->getCkLangCode()}.php";


    if($manager->validateToken()) {
        $usrObj = Usr::factory();
        $usrObj = $usrObj->getUsrByIdUsr($manager->getSeIdUsr())[0];

        $videoObj = Video::Factory();
        $videoArr = $videoObj->getVideoByIdUsr($usrObj->getIdUsr());
    } else {
		header('Location: ../index.php');
    }
?>
<!doctype html>
<html lang="<?=$manager->getCkLangCode()?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="<?=$strKeyWords?>">

	<title><?=$strWebName?></title>
	<meta name="description" content="<?=$strDescription?>">
	<meta name="author" content="<?=$strAuthor?>">

	<link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<link rel="manifest" href="favicon/site.webmanifest">

    <link rel="stylesheet" href="css/general.css">
</head>

<body class="index">
	<header><?=$webComp->getHeader(1)?></header>
	
	<div id="container">
        <img src="img/indexPic1.png" alt="cover">
        <div class="titleDiv">
            <h1><?=$strIndex1?></h1>
            <h4><?=$strIndex2?></h4>
        </div>
        <div class="btnDiv">
            <a class="btnPrim btnBlue" href="html/login.php"><?=$strBtn5?></a>
            <a class="btnSecond" href="html/register.php"><?=$strBtn7?></a>
            <br class="clear">
        </div>
	</div>
	
    <?php 
    if($manager->getAgent()=="wiiu"){
        echo "<footer style='visibility: hidden;'>&nbsp;</footer>"; 
    }else{
        echo "<footer class='bottomFooter'>".$webComp->getFooter()."</footer>";    
    }
    ?>
	
</body>
</html>
