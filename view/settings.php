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
    } else {
		header('Location: ../index.php');
    }
?>

<!doctype html>
<html lang="<?=$manager->getCkLangCode()?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?=$strTitle4?></title>
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
		<section>
			<h1 class="secTitle"><?=$strNav1?></h1>
			<article class="contPanel" >
                <h2 style="display: none;">h2</h2>
                <form name="formSettings" id="formSettings" action="execute.php" 
                    method="post" enctype="multipart/form-data">

                    <input id="queryType" name="queryType" type="hidden" value="save_settings" >
				    <table>
                        <tr>
                            <td><?=$strSettins1?>:</td>
                            <td><?=$usrObj->getUsrName()?></td>
                        </tr>
                        <tr>
                            <td><?=$strSettins3?>:</td>
                            <td><a href="delusr.php" style="color: red;"><?=$strSettins4?></a></td>
                        </tr>
                        <tr>
                            <td><?=$strSettins2?>:</td>
                            <td>
                                <select name="selectLang" id="selectLang">
                                    <option value="en" <?=$manager->checkSelectedLang("en")?>>
                                        <?=$strLang1?>
                                    </option>
                                    <option value="es" <?=$manager->checkSelectedLang("es")?>>
                                        <?=$strLang2?>
                                    </option>
                                </select>                            
                            </td>
                        </tr>
                    </table>
			        <input type="submit" id="btnSave" class="btnPrim btnBlue" 
                        value="<?=$strEdit7?>">
				</form>
			</article>
		</section>
	</div>
	
	<footer><?=$webComp->getFooter()?></footer>
</body>
</html>
