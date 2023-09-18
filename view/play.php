<?php
	include_once "../php/funDb.php";
	include_once "../php/bd.php";
	include_once "../php/cookieManager.php";
	$idUsr = null;
	$idUsr=validateCookie($bd,0);

    include_once "../php/lang.php";
    $lang=getLang();
    include "../php/".$lang.".php";
	if(validateVidId()){
		include_once "../php/userAgent.php";
		
		$result = getVidById($_GET["vid"], $idUsr, $bd);
		$src= $result[0]->url;

		switch (detectUserAgent()) {
			case "wiiu":
				header('Location: '.$src);
				break;
		}
		header('Location: '.$src);
	}else{
		header('Location: list.php');
	}
	
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

	<link rel="stylesheet" href="../css/general.css">
	
	<link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
</head>

<body class="viewIframe" >
	<script src="../script/wiiu.js"></script>
	
	<script>
		var globalLoad = false;
		window.onload = function() {
		
			//waitVid();
			/*
			switch (detectUserAgent()) {
				case 'wiiu':
					redirect();
					//validateRediForm();
					break;
				default:
					waitVid();
			}
			*/
		};
		
		function waitVid() {
			setTimeout(function () {
				var video = document.getElementById("vid");
				if(video.readyState >= 3){
					globalLoad = true;	
				}
				ckVid();
			}, 4000);
		}
		
		function ckVid() {
			if(globalLoad){
				enableVideo()
			}else{
				enableFrame();
			}
		}
		
		function enableFrame(){
			var video = document.getElementById("vid");
			var frame = document.getElementById("videoFrame");
			var inSrc = document.getElementById("inSrc");
			video.style.display= "none";
			frame.src = inSrc.value;
		}
		
		function enableVideo(){
			var video = document.getElementById("vid");
			var frame = document.getElementById("videoFrame");
			video.style.display= "block";
			frame.style.display= "none";
		}
		
		function validateRediForm() {
			var frm = document.forms['formRedi'];
			frm.action = "../php/redirect.php";
			frm.submit();
		}
		
		function redirect(){
			var inSrc = document.getElementById("inSrc").value;
			window.open('http://stackoverflow.com', '_blank');
			
			var frame = document.getElementById("videoFrame");
			frame.style.display= "none";
	
			
		}
		
	</script>
	
	<header style="visibility:hidden;">&nbsp;</header>
	
	<div id="container">
		<form name="formRedi" id="formRedi" action="#" method="post" enctype="multipart/form-data">
			<input id="inSrc" name="inSrc" type="hidden" value="<?= $src ?>">
			<input style="display: none;" type="submit" value="go"/>
		</form>
		
		 <video
			id="vid"
			class="video-js"
			controls
			preload="auto"
			width="640"
			height="264"
			data-setup='{"fluid": true}'
			crossorigin="anonymous"
		  >
			<source src="<?= $src ?>" type="video/mp4" />
			<source src="<?= $src ?>" type="video/webm" />
			<p class="vjs-no-js">
			  To view this video please enable JavaScript, and consider upgrading to a
			  web browser that
			  <a href="https://videojs.com/html5-video-support/" target="_blank"
				>supports HTML5 video</a
			  >
			</p>
		  </video>

		  <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
		
			
	</div>
			
	
	<footer style="visibility:hidden;">&nbsp;</footer>
	
	<script>

	</script>
	
</body>
</html>

