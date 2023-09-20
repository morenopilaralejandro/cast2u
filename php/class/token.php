<?php
require_once __DIR__ . '/../dbConnection.php';
class Video {
    //TODO db integration
    private int $idToken;
    private string $stringToken;
    private string $creationDate;
    private int $idUsr;

    //functions
    generateUniqueToken(){

    }
    
    //db
    public function getVideoByIdVid(int $idVid): Array {   
        $sql = 'select id_vid as idVid, url, img, title, upload_date as uploadDate, 
            counter_enabled as counterEnabled, counter_value as counterValue, 
            id_usr as idUsr from video where id_vid = :idVid';
        $params = ['idVid' => $idVid];
        //placeholder parameters for constructor
        $ctor_args= [0, '', '', '', '', '', 0, 0];

        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stm->execute($params);
            return $stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Video', $ctor_args);
        } catch(PDOException $e) { 
            echo $e->getMessage();
            return Array();
        } 
	}

    public function insert(int $idVid, string $url, string $img, 
        string $title, string $uploadDate, bool $counterEnabled, 
        int $counterValue, int $idUsr): bool {
        
        $sql = 'insert into video (url, img, title, upload_date, 
            counter_enabled, counter_value, id_usr) values (:url, :img, :title, 
            SYSDATE(), :counterEnabled, :counterValue, :idUsr)';
        $params = [
            'url' => $url, 
            'img' => $img, 
            'title' => $title, 
            //uploadDate ------> SYSDATE()
            'counterEnabled' => false, 
            'counterValue' => 0,
            'idUsr' => $idUsr]; 
     
        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            return $stm->execute($params);
        } catch(PDOException $e) { 
            echo $e->getMessage();
            return false;
        } 
    }

    public function delete(): bool { 
        $sql = 'delete from video where id_vid = :idVid';
        $params = ['idVid' => $this->idVid]; 
     
        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            return $stm->execute($params);
        } catch(PDOException $e) { 
            echo $e->getMessage();
            return false;
        } 
    }

    //constructor
    public function __construct(int $idVid, string $url, string $img, 
        string $title, string $uploadDate, bool $counterEnabled, 
        int $counterValue, int $idUsr) {
        
        $this->idVid=$idVid;
        $this->url=$url;
        $this->img=$img;
        $this->title=$title;
        $this->uploadDate=$uploadDate;
        $this->counterEnabled=$counterEnabled;
        $this->counterValue=$counterValue;
        $this->idUsr=$idUsr;
    }

    //factory
    public static function factory() : Video {
        return new Video(0, '', '', '', '', false, 0, 0);
    } 

    //setter getter
    function setIdToken(int $idToken): bool { 
        $this->idToken = $idToken; 
    }
    function getIdToken(): int { 
        return $this->idToken; 
    }

    function setStringToken(string $stringToken): bool { 
        $this->stringToken = $stringToken; 
    }
    function getStringToken(): string { 
        return $this->stringToken; 
    }

    function setCreationDate(string $creationDate): bool { 
        $this->creationDate = $creationDate; 
    }
    function getCreationDate(): string { 
        return $this->creationDate; 
    }
    
    function setIdUsr(int $idUsr): bool { 
        $this->idUsr = $idUsr; 
    }
    function getIdUsr(): int { 
        return $this->idUsr; 
    }
}
?>
