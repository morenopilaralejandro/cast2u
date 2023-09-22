<?php 
    //TODO delete file (unused)
	if(isset($_POST["inSrc"])){
		header("Location: ".$_POST["inSrc"]);
	}else{
		header('Location: ../html/list.php');
	}
?>
