<?php
    function getCkLang(){
        $lang = "en";
	    
	    if(isset($_COOKIE['ckLang'])){
		    $lang = $_COOKIE['ckLang'];
	    }else{
		    $lang = "en";
		    setcookie("ckLang", $lang, time()+3600*24*7, '/');
	    }	
        return $lang;
    }
	

    function setCkLang(){
	    if(isset($_POST['selectLang'])){
		    $lang = $_POST['selectLang'];
		    setcookie("ckLang", $lang, time()+3600*24*7, '/');
	    }	
    }

    function isSelectedLang($value, $lang){
	    if($value==$lang){
		    return " selected ";
	    }else{
            return "";
        }
    }
?>
