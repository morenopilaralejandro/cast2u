<?php

function getHeader($opt){
    $lang=getLang();
    include $lang.".php";
    $header="";
    $mainLink="";
    switch($opt){
        case 1:
            $mainLink="#";
            break;
        case 2:
            $mainLink="../index.php";
            break;
        default:
            $mainLink="panel.php";       
    }
    $header.="<a class='headerTitle' href='".$mainLink."'>";
    $header.=$strWebName;
    $header.="</a>";
    if($opt==0){
        $header.="<div id='headerNav' class='hideNav'>";
        $header.="<a href='#'><img onclick='showNav();' class='hamburger' src='../img/hamburger.png' alt='menu'/></a>";
        $header.="<nav>";
            $header.="<a href='settings.php'>";
            $header.=$strNav1;
            $header.="<img src='../img/settings.png' alt='setting_img' />";
            $header.="</a>";

            $header.="<a href='logout.php'>";
            $header.=$strNav2;
            $header.="<img src='../img/exit.png' alt='exit_img' />";
            $header.="</a>";
        $header.="</nav>";
        $header.="</div>";
    }
    return $header;
}

function getFooter(){
    $lang=getLang();
    include $lang.".php";
    $footer="";
    $footer.="<span>2022</span>";
    return $footer;
}

function getNoVideos(){
    $lang=getLang();
    include $lang.".php";
    $content="";
    $content.="<span class='noVideos'>".$strError1."</span>";
    return $content;
}

?>
