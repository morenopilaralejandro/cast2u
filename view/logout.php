<?php
    //TODO
    //poner en execute-confirm  
	include_once "../php/cookieManager.php";
    include_once "../php/lang.php";
    $lang=getLang();
    include "../php/".$lang.".php";
    logOut();
	header('Location: ../index.php');
?>
<!doctype html>
<html lang="<?=$lang?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=$stTitle00?></title>
	<meta name="description" content="<?=$stDescription?>">
	<meta name="author" content="<?=$stAuthor?>">


	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">


</head>

<body>	
    <header style="visibility:hidden;">&nbsp;</header>
    <footer style="visibility:hidden;">&nbsp;</footer>
</body>
</html>



