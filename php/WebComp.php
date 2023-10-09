<?php
require_once __DIR__ . '/class/Video.php';
class webComp {
    private string $langFile;

    //functions
    function getHeader(int $optRedir, bool $showHamburger): string {
        include __DIR__ . $this->langFile;
        $mainLink = "";
        switch($optRedir){
            case 1:
                $mainLink = "#";
                break;
            case 2:
                $mainLink = "../index.php";
                break;
            default:
                $mainLink = "panel.php";       
        }
        $inner = "";
        $inner .= "<a class='headerTitle' href='{$mainLink}'>{$strWebName}</a>";
        if($showHamburger) {
            $inner .= "
            <div id='headerNav' class='hideNav'>
                <a href='#'>
                    <img onclick='showNav();' class='hamburger' 
                        src='../img/hamburger.png' alt='menu'>
                </a>
                <nav>
                    <a href='settings.php'>
                        {$strNav1}
                        <img src='../img/settings.png' alt='setting_img' >
                    </a>

                    <a href='logout.php'>
                        {$strNav2}
                        <img src='../img/exit.png' alt='exit_img' >
                  </a>
                </nav>
            </div>";
        }
        return $inner;
    }

    public function getFooter(): string {
        include __DIR__ . $this->langFile;
        $inner = "<span>2023</span>";
        return $inner;
    }

    public function getNoVideos(): string{
        include __DIR__ . $this->langFile;
        $inner = "<span class='noVideos'>{$strError1}</span>";
        return $inner;
    }

	public function getListItem(Video $videoObj, string $agent): string {
        $inner = "<div class='videoListItem' title='{$videoObj->getTitle()}'>";
        if($agent != "wiiu") {
           $inner .= "
            <a class='editShortcut' href='edit.php?v={$videoObj->getIdVid()}' target='_blank'>
                <img class='imgIcon' src='../img/edit.png' alt='e'>
            </a>";
        }
		$inner .= "
            <a class='aListItem' href='play.php?v={$videoObj->getIdVid()}' target='_blank'>
                <img class='imgThumb' src='{$videoObj->getImg()}' alt='thumb'>
			    <span>{$videoObj->getTitle()}</span>
            </a>
		</div>";
		return $inner;
	}

	public function getPanelItem(Video $videoObj, int $j, int $max): string {
        include __DIR__ . $this->langFile;
        $styleUp = ''; 
        $styleDown = ''; 
        if($j == 1) {
            $styleUp = 'visibility: hidden;';
        }
        if($j == $max) {
            $styleDown = 'visibility: hidden;';
        }
		$inner = "
		<div class='videoPanelItem'>
            <div class='videoPanelItemMain'>
                <a href='edit.php?v={$videoObj->getIdVid()}'>
                    <img src='{$videoObj->getImg()}' alt='thumb'>
                    <span>{$videoObj->getTitle()}</span>
                    <span class='spanUploadDate'>
                        {$strPanel1}
                        {$videoObj->getUploadDate()}
                    </span>
                </a>
            </div>
            <div class='videoPanelItemSide'>
                <a href='orderup.php?v={$videoObj->getIdVid()}' style='{$styleUp}'>
                    <img class='upArrow' src='../img/up_arrow.png' alt='up'>
                </a>
                <a href='orderdown.php?v={$videoObj->getIdVid()}' style='{$styleDown}'>
                    <img class='downArrow' src='../img/down_arrow.png' alt='down'>
                </a>
            </div>
        </div>";
		return $inner;
	}

    public function getAd(): string {
        $inner = "
        <div class='adMobileLeaderboard'>
            <a href='http://drivefullthrottle.great-site.net/html/quiz.php' 
                target='_blank' title='DriveFullThrottle'>
 
                <img src='../img/ad.png' alt='ad'>
            </a>
        </div>";
		return $inner;
    }

    public function getConfDialog(string $confMsg, string $btn1, string $btn2, 
        string $action1, string $action2, string $queryType): string {

        include __DIR__ . $this->langFile;
        $inner = "
        <div class='divConfDialog'>
            <h3>{$confMsg}</h3>
            <form name='fromConfDialog' id='fromConfDialog' action='{$action1}' 
                class='fromConfDialog' method='post' enctype='multipart/form-data'>

                <input id='queryType' name='queryType' type='hidden' 
                    value='{$queryType}' >

                <div class='divConfBtn'>
                    <input type='submit' class='btnPrim' id='btnConf'
                        value='{$btn1}'>
                    <a  class='btnPrim btnSecond' href='{$action2}'>{$btn2}</a>
                </div>
            </form>
        </div>
        ";
        return $inner;
    }

    //constructor
    public function __construct(string $langFile) {
        $this->langFile = "/../php/lang/{$langFile}.php";
    }

    //setter getter
    public function setLangFile(string $langFile) { 
        $this->langFile = $langFile; 
    }
    public function getLangFile(): string { 
        return $this->langFile; 
    }    
} 
?>
