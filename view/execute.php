<?php
    //TODO
    //renombrar por confirm y mostrar pop up si es necesario 
	include_once "../php/funDb.php";
	include_once '../php/bd.php'; 
	include_once "../php/cookieManager.php";
    include_once "../php/lang.php";
    $lang=getLang();
    include "../php/".$lang.".php";

	$queryType = $_POST["queryType"];
	if(isset($queryType)){
		switch ($queryType) {
			case "insert_user":
				$username = $_POST["username"];
				$passEnc = $_POST["passEnc"];
				if(strlen($passEnc)==32 && strlen($username)>0){
					$result = null;
                    $sql = insertUsr($username, $passEnc, $bd);
					if($sql==0){ 
                        $result = getUsrByName($username, $bd);
                        $_SESSION["seIdUsr"]=$result[0]->id_usr;
                        $sql = generateToken(0, $bd);
						header('Location: panel.php');
					} else{ 
						header('Location: register.php');
                        setError($stError4);
					} 
				}
				break;
			case "login_user":
				$username = $_POST["username"];
				$passEnc = $_POST["passEnc"];
				if(strlen($passEnc)==32 && strlen($username)>0){
					$result = getUsrByName($username, $bd);
					if(count($result)>0){
						if($result[0]->pwd == $passEnc){
                            $_SESSION["seIdUsr"]=$result[0]->id_usr;
							storeDbToken($bd);
							header('Location: list.php');
						}else{
							header('Location: login.php');
                            setError($stError2);
						}
					}else{
						header('Location: login.php');
                        setError($stError2);
					}	
				}
				break;
			case "update_vid":
				$idUsr=validateCookie($bd,0);
				$id_vid = $_POST["id_vid"];
				$url = $_POST["url"];
				$img = $_POST["img"];
				$title = $_POST["title"];
				$result = updateVid($id_vid, $title, $img, $url, $idUsr, $bd);
				header('Location: panel.php');
				break;
			case "insert_vid":
				$idUsr=validateCookie($bd,0);
				$url = $_POST["url"];
				$img = $_POST["img"];
				$title = $_POST["title"];
				$result = insertVid($url, $img,$title, $idUsr, $bd);
				header('Location: panel.php');
				break;
			case "del_vid":
				$idUsr=validateCookie($bd,0);
				$id_vid = $_POST["id_vid"];
				$result = deleteVid($id_vid, $idUsr, $bd);
				header('Location: panel.php');
				break;
			case "save_settings":
                setLang();
				header('Location: panel.php');            
				break;
			case "delete_user":
                $idUsr=validateCookie($bd,0);
                $result = deleteUsr($idUsr, $bd);
                logOut();
                $_SESSION["sesConfMsg"]= $stConf1;
                header('Location: confirm.php');
				break;
			default:
       			header('Location: ../index.php');
		}
	}else{
		header('Location: ../index.php');
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


</head>

<body>
    <header style="visibility:hidden;">&nbsp;</header>
    <footer style="visibility:hidden;">&nbsp;</footer>	
</body>
</html>



