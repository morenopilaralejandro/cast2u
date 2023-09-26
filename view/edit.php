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
        $edit = false;
        $idVid = "";
        $url = "";
        $img = "";
        $title = "";
	    if(isset($_GET['vid'])) {
            $idVid = $_GET['vid'];
            if($manager->validateIdVid($idVid)) {
                $videoObj = Video::Factory();
                $videoObj = $videoObj->getVideoByIdVid($idVid)[0];

		        $edit = true;
		        $queryType = "update_vid";
		        $url = $videoObj->getUrl();
		        $img = $videoObj->getImg();
		        $title = $videoObj->getTitle();
            }
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
			<h1 class="secTitle">
				<?php
					if($edit){
						echo $stEdit8;
					}else{
						echo $stEdit9;
					}
				?>
				
			</h1>
			<article class="contPanel" >
                <h1 style="display: none;">h1</h1>
				<form name="formEdit" id="formEdit" action="execute.php" method="post" 
                    enctype="multipart/form-data">

					<input id="title" name="title" type="text" 
                        maxlength="32" placeholder="<?=$stEdit1?>" value="<?=$title?>"/>

					<textarea placeholder="<?=$stEdit2?>" 
                        id="img" name="img"><?=$img?></textarea>

					<textarea placeholder="<?=$stEdit3?>" 
                        id="url" name="url" ><?=$url?></textarea>

					<input id="id_vid" name="id_vid" type="hidden" value="<?=$id_vid?>" />
					<input id="queryType" name="queryType" type="hidden" value="<?=$queryType?>" />
					<input type="button" value="<?=$stEdit4?>" onclick="clearInput('url')">
					<?php
						if($isEdit){
							echo "<label class='deleteLabel' >";
                            echo "<input type='checkbox' id='ckDel' onclick='ckDelete()'/>";
                            echo $stEdit5;
                            echo "</label>";
							echo "<a style='margin-left:0px;' class='btnPrim' id='btnDel' onclick='deleteVid()' href='#'>";
                            echo $stEdit6;
                            echo "</a>";
						}
					?>

					<input style="display: none;" type="submit" onclick="validateEditForm()" 
                        value="<?=$stEdit7?>"/>
					<a class="btnPrim btnBlue btnR" id="btnSave" onclick="validateEditForm()" 
                        href="#"><?=$stEdit7?></a>
				</form>
			</article>
		</section>
	</div>
	
	<footer><?=$webComp->getFooter()?>></footer>
	
	<script>
		ckImg();
	</script>
</body>
</html>
