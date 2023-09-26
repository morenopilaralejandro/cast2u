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
        $usrObj = Usr::factory();
        $usrObj = $usrObj->getUsrByIdUsr($manager->getSeIdUsr())[0];
        header('Location: list.php');
    } else {
        $errorMsg = $manager->getCkError();
        $manager->clearCkLangCode();
    }
?>
<!doctype html>
<html lang="<?=$manager->getCkLangCode()?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?=$strTitle5?></title>
	<meta name="description" content="<?=$strDescription?>">
	<meta name="author" content="<?=$strAuthor?>">

	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">

	<link rel="stylesheet" href="../css/general.css">

</head>

<body>
    <script src="../script/general.js"></script>

	<header><?=$webComp->getHeader(0)?></header>
	
	<div id="container">
		<form name="formLogin" id="formLogin" class="formBasic" action="execute.php" 
                method="post" enctype="multipart/form-data">
            <label for="email"><?=$strForm6?></label>
			<input id="email" name="email" type="email" maxlength="32">

            <label for="pass"><?=$strForm2?></label>
			<input id="pass" name="pass" type="password" maxlength="32" minlength="4">

			<input id="queryType" name="queryType" type="hidden" value="login_user">

            <span id="errorSpan"><?=$errorMsg?></span>

			<input type="submit" class="btnPrim btnBlue" value="<?=$strForm4?>">
		</form>	
	</div>
	
	<footer><?=$webComp->getFooter()?></footer>	
</body>
</html>
