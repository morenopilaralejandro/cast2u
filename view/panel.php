<?php 
	include_once "../php/funDb.php";
	include_once "../php/bd.php";
	include_once '../php/videoListItem.php'; 
	include_once "../php/cookieManager.php";
    include_once "../php/webComponents.php";
    include_once "../php/lang.php";
    $lang=getLang();
    include "../php/".$lang.".php";
	$idUsr = null;
	$idUsr=validateCookie($bd,1);
	$result = getVidByUser($idUsr,$bd);
?>
<!doctype html>
<html lang="<?=$lang?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?=$strTitle2?></title>
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

	<header><?=getHeader(0)?></header>
	<div id="container">
		<section>
			<h1 class="secTitle"><?=$stEdit0?></h1>
			<article class="contPanel" >
                <h1 style="display: none;">h1</h1>
				<?php 
                    if(count($result)>0){
                        foreach ($result as $i) {
						    echo printPanelItem($i);
					    }
                    }else{
                        echo printNoVideos();
                    }
				?>
				
				<a class="btnPrim btnFloat btnGreen " href="edit.php">
                    <img class="icoAdd" src="../img/add.png" alt="add">
                </a>
			</article>
		</section>	
        <?php 
        if(count($result)>0){
            echo "<a class='btnPrim btnGray' href='list.php'>".$stBtn2."</a>";
        }
        ?>
		
	</div>
	<footer><?=getFooter()?></footer>
</body>
</html>
