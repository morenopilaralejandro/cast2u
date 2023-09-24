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

	<header><?=$webComp->getHeader(0)?></header>
	<div id="container">
		<section>
			<h1 class="secTitle"><?=$strEdit0?></h1>
			<article class="contPanel" >
                <h2 style="display: none;">h2</h2>
				<?php 
                    if(count($videoArr)>0){
			            $j=1;
                        foreach ($videoArr as $i) {
						    echo $webComp->getPanelItem($i, $j, count($videoArr));
				            $j++;
					    }
                    }else{
                        echo $webComp->getNoVideos();
                    }
				?>
				<br class="clear">
				<a class="btnPrim btnFloat btnGreen " href="edit.php">
                    <img class="icoAdd" src="../img/add.png" alt="add">
                </a>
			</article>
		</section>	
        <?php 
        if(count($videoArr)>0){
            echo "<a class='btnPrim btnGray' href='list.php'>".$strBtn2."</a>";
        }
        ?>
		
	</div>
	<footer><?=$webComp->getFooter()?></footer>
</body>
</html>
