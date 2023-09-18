<?php
require_once __DIR__ . '/../dbConnection.php';
class Usr {
    //TODO db_connection
    private int $idUsr;
    private string $usrName;
    private string $pwd;
    private string $email;

    //db
    public function getVideoByIdVid(int $idVid): Array {   
        $sql = 'select id_vid as idVid, url, img, title, upload_date as uploadDate, 
            counter_enabled as counterEnabled, counter_value as counterValue, 
            id_usr as idUsr from video where id_vid = :idVid';
        $params = ['idVid' => $idVid];
        //placeholder parameters for constructor
        $ctor_args= [0, '', '', ''];

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

    public function insert(int $idUsr, string $usrName, 
        string $pwd, string $email): bool {
        
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
        $params = ['idVid' => $idVid]; 
     
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
    public function __construct(int $idUsr, string $usrName, 
        string $pwd, string $email) {
        
        $this->asd=$asd;
    }

    //factory
    public static function factory() : Video {
        return new Usr(0, '', '', '');
    } 

    //setter getter
        public function setIdUsr(int $idUsr): bool { 
        $this->idUsr = $idUsr; 
    }
    public function getIdUsr(): int { 
        return $this->idUsr; 
    }

    public function setUsrName(string $usrName): bool { 
        $this->usrName = $usrName; 
    }
    public function getUsrName(): string { 
        return $this->usrName;
    }

    public function setPwd(string $pwd): bool { 
        $this->pwd = $pwd; 
    }
    public function getPwd(): string { 
        return $this->pwd; 
    }

    public function setEmail(string $email): bool { 
        $this->email = $email; 
    }
    public function getEmail(): string { 
        return $this->email; 
    }
}
?>
