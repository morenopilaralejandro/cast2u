<?php 
	session_start();

    require_once __DIR__ . '/../php/class/Video.php';
    require_once __DIR__ . '/../php/class/Token.php';
    require_once __DIR__ . '/../php/SeCkManager.php';
    require_once __DIR__ . '/../php/WebComp.php';

    $manager = new SeCkManager();

    //$videoObj = Video::factory();
    //$videoObj = $videoObj->getVideoByIdUsr(1)[0];
    //print_r($videoObj->getVideoByIdUsr(1));
    //print_r($videoObj->setTitle('xddddddddddddddddd'));
	
?>
<!doctype html>
<html lang="en">
	
	

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="keywords" content="">



	<title>Video Home</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
	<link rel="manifest" href="../favicon/site.webmanifest">

	<link rel="stylesheet" href="../css/general.css">

</head>

<body>
	<script src="../script/wiiu.js"></script>
	
	
	<header></header>
	
	<div id="container">
<?php 
	
   
	
?>

	</div>
	
	<footer></footer>
	
	<script>
		

	
	</script>
	
</body>
</html>
