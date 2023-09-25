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

	<title><?=$strTitle1?></title>
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
	<?php
        if($manager->getAgent() == "wiiu") {
            echo "<header style='display: none;';>header</header>";
        }else{
	        echo "<header>{$webComp->getHeader(0)}</header>";
        }
    ?>
	<div id="container">
		<?php 
            if(count($videoArr) > 0) { 
			    $j=1;
			    foreach ($videoArr as $i) {
				    if($j%2 != 0) {
					    echo "<div class='listContainer'>";
				    }
				    echo $webComp->getListItem($i, $manager->getAgent());
				    if($j%2 == 0){
					    echo "</div>";
                        if($j<=2) {
                            echo $webComp->getAd();
                        }
				    }
				    $j++;
			    }
			    if($j%2 == 0 ) {
				    echo "</div>";
                    if($j<=2) {
                        echo $webComp->getAd();
                    }
			    }
            }else{
                echo $webComp->getNoVideos();
            }
		?>
		<a class="btnPrim btnGray" href="panel.php"><?=$strBtn1?></a>
	</div>
	<footer><?=$webComp->getFooter()?></footer>
</body>
</html>
