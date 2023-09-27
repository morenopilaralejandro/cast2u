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

        $queryType = "insert_vid";
        $isEdit = false;
        $pageTitle = "";

        $idVid = "";
        $url = "";
        $img = "";
        $title = "";
        $counterEnabled = false;
        $counterValue = 0;
	    if(isset($_GET['v'])) {
            $idVid = $_GET['v'];
            if($manager->validateIdVid($idVid)) {
                $videoObj = Video::Factory();
                $videoObj = $videoObj->getVideoByIdVid($idVid)[0];

		        $isEdit = true;
		        $queryType = "update_vid";
		        $url = $videoObj->getUrl();
		        $img = $videoObj->getImg();
		        $title = $videoObj->getTitle();
                $counterEnabled = $videoObj->getCounterEnabled();
                $counterValue = $videoObj->getCounterValue();
                if($img == "../img/def_thumb.jpg") {
                    $img = "";
                }
            }
	    }
        if($isEdit){
            $pageTitle = $strEdit8;
        }else{
            $pageTitle = $strEdit9;
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

	<title><?=$strTitle3?></title>
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
	
	<script>
		function validateEditForm() {
			let frm = document.forms['formEdit'];
            frm.action = "execute.php";
			if(frm.img.value === ""){
			   frm.img.value = "../img/def_thumb.jpg";
			}	
			frm.submit();
		}
		
		function ckImg() {
			let frm = document.forms['formEdit'];
			if(frm.img.value === "../img/def_thumb.jpg"){
			   frm.img.value = "";
			}
		}
		
		function deleteVid(){
			let frm = document.forms['formEdit'];
			frm.queryType.value = "del_vid";
			validateEditForm();
		}






		
		function ckDelete() {
			var ckDel = document.getElementById("ckDel");
			var btnDel = document.getElementById("btnDel");
			var btnSave = document.getElementById("btnSave");
			if (ckDel.checked == true){
				btnDel.style.display = "block";
				btnSave.style.display = "none";
			} else {
				btnSave.style.display = "block";
				btnDel.style.display = "none";
			}
		}
		
	</script>
	
	<header><?=$webComp->getHeader(0, true)?></header>
	
	<div id="container">
		<section>
			<h1 class="secTitle"><?=$pageTitle?></h1>
			<article class="contPanel">
                <h2 style="display: none;">h2</h2>
				<form name="formEdit" id="formEdit" action="execute.php" 
                    method="post" enctype="multipart/form-data">
                    
                    <input id="queryType" name="queryType" type="hidden" 
                        value="<?=$queryType?>">     
                    
					<input id="id_vid" name="id_vid" type="hidden" 
                        value="<?=$idVid?>">
             
                    <label class="labelInline">
                        <?=$strEdit1?>
                        <input id="title" name="title" type="text" maxlength="32" 
                            value="<?=$title?>">
                    </label>
                 
                    <label>
                        <?=$strEdit2?>
					    <textarea id="img" maxlength="2000" 
                            name="img"><?=$img?></textarea>            
                    </label>

                    <label>
                        <?=$strEdit3?>
					    <textarea id="url" maxlength="2000" 
                            name="url"><?=$url?></textarea>          
                    </label>

					<input type="button" value="<?=$strEdit4?>" 
                        onclick="clearInput('url')">

                    <label class="labelInline"><input type='checkbox' 
                        id='ck_counter' name="ck_counter"
                        <?php
                            if($counterEnabled) {
                                echo "checked";
                            }
                        ?>
                    ><?=$strEdit10?>
                        <span class="tooltip">
                            <img src="../img/info.png" alt="tooltip">
                            <span><?=$strEdit12?></span>
                        </span>
                    </label>
            
                    <label class="labelInline"><?=$strEdit11?>
                        <input type="number" id="value_counter" name="value_counter"
                            min="-9999" max="9999"
                            value="<?=$counterValue?>">
                    </label>

					<?php
						if($isEdit){
							echo "<label class='deleteLabel' >";
                                echo "<input type='checkbox' id='ckDel' 
                                    onclick='ckDelete()'>";
                                echo $strEdit5;
                            echo "</label>";
							echo "<a style='margin-left:0px;' class='btnPrim' 
                                id='btnDel' href='delvid.php?v={$idVid}'>";
                                echo $strEdit6;
                            echo "</a>";
						}
					?>

					<input type="submit" class="btnPrim btnBlue btnR" 
                        id="btnSave" value="<?=$strEdit7?>">
				</form>
			</article>
		</section>
	</div>
	<footer><?=$webComp->getFooter()?></footer>
</body>
</html>
