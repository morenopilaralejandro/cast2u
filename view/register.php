<?php 
    include_once "../php/funDb.php";
    include_once "../php/cookieManager.php";
    include_once "../php/lang.php";
    include_once '../php/webComponents.php';
    $lang=getLang();
    include "../php/".$lang.".php";
?>
<!doctype html>
<html lang="<?=$lang?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?=$stTitle6?></title>
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
		
		function validateRegisterForm() {
			var frm = document.forms['formRegister'];
			if(frm.username.value.length>0){
				if(frm.pass.value.length>=4){
					if(frm.pass.value===frm.pass2.value){
						frm.passEnc.value = MD5(unescape(encodeURIComponent(frm.pass.value)));
						frm.action = "execute.php";
						frm.submit();
					}else{
                        var errorSpan= document.getElementById("errorSpan");
                        errorSpan.innerHTML=frm.auxMsg.value;
                        event.preventDefault();
                    }
				}
			}
		}
	</script>
	
	<header><?=getHeader(2)?></header>
	
	<div id="container">
		<form name="formRegister" id="formRegister" class="formBasic" action="#" method="post" enctype="multipart/form-data">
            <label for="username"><?=$stForm1?></label>
			<input id="username" name="username" type="text" maxlength="32" />
            <label for="pass"><?=$stForm2?></label>
			<input id="pass" name="pass" type="password" maxlength="32" minlength="4"/>
            <label for="pass2"><?=$stForm3?></label>
			<input id="pass2" name="pass2" type="password" maxlength="32" minlength="4"/>
			<input id="passEnc" name="passEnc" type="hidden"/>
			<input id="queryType" name="queryType" type="hidden" value="insert_user" />
            <input id="auxMsg" name="auxMsg" type="hidden" value="<?=$stError3?>" />
            <span id="errorSpan"><?=getError()?><?=clearError()?></span>
			<input type="submit" class="btnPrim btnGreen" onclick="validateRegisterForm()" value="<?=$stForm5?>"/>
		</form>
		
	</div>
	
	<footer><?=getFooter()?></footer>
	
	<script>

	</script>
	
</body>
</html>



