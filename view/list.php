<?php 
	include_once "../php/funDb.php";
	include_once "../php/bd.php";
	include_once '../php/videoListItem.php'; 
	include_once "../php/cookieManager.php";
    include_once "../php/webComponents.php";
    include_once "../php/userAgent.php";
    include_once "../php/lang.php";
    $lang=getLang();
    switch ($lang) {
        case "en":
            include "../php/en.php";
            break;
        case "es":
            include "../php/es.php";
            break;
        default:
            include "../php/en.php";
            break;
    }	
	$idUsr = null;
	$idUsr=validateCookie($bd,0);
	$result = getVidByUser($idUsr,$bd);
    $agent= detectUserAgent();
?>
<!doctype html>
<html lang="<?=$lang?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?=$stTitle1?></title>
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
	<?php
        if($agent=="wiiu"){
            echo "<header style='display: none;';>header</header>";
        }else{
	        echo "<header>".getHeader(0)."</header>";
        }
    ?>
	<div id="container">
		<?php 
            if(count($result)>0){
			    $j=1;
			    foreach ($result as $i) {
				    if($j%2!=0){
					    echo "<div class='listContainer'>";
				    }
				    echo printListItem($i);
				    if($j%2==0){
					    echo "</div>";
				    }
				    $j++;
			    }
			    if($j%2==0){
				    echo "</div>";
			    }
            }else{
                echo printNoVideos();
            }
		?>
		<a class="btnPrim btnGray" href="panel.php"><?=$stBtn1?></a>
	</div>
	<footer><?=getFooter()?></footer>
</body>
</html>
