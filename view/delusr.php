<?php 
	include_once "../php/funDb.php";
	include_once "../php/bd.php";
	include_once '../php/videoListItem.php'; 
	include_once "../php/cookieManager.php";
    include_once '../php/webComponents.php'; 
	$idUsr = null;
	$idUsr=validateCookie($bd,0);
	
	include_once "../php/lang.php";
    $lang=getLang();
    include "../php/".$lang.".php";

?>

<!doctype html>
<html lang="<?=$lang?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?=$stTitle4?></title>
	<meta name="description" content="<?=$stDescription?>">
	<meta name="author" content="<?=$stAuthor?>">

	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">

	<link rel="stylesheet" href="../css/general.css">

</head>

<body>
	<script src="../script/general.js"></script>
	
	<script>
		function validateSettingsForm() {
			let frm = document.forms['formSettings'];
            frm.action = "execute.php";	
			frm.submit();
		}
	</script>
	
	
	<header><?=getHeader(0)?></header>
	
	
	<div id="container">
		<section>
			<h1 class="secTitle"><?=$stSettins3?></h1>
			<article class="contPanel" >
                <h1 style="display: none;">h1</h1>
                <form name="formSettings" id="formSettings" action="#" method="post" enctype="multipart/form-data">
                    <input id="queryType" name="queryType" type="hidden" value="delete_user" />
					<a class="btnPrim btnRed" id="btnSave" onclick="validateSettingsForm()" href="#"><?=$stBtn4?></a>
				</form>
			</article>
		</section>
	</div>
	
	<footer><?=getFooter()?></footer>
	
	<script>
		
	</script>
	
</body>
</html>



