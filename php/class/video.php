<?php
require_once __DIR__ . '/../dbConnection.php';
class Video {
    private int $idVid;
    private string $url;
    private string $img;
    private string $title;
    private string $uploadDate;
    private bool $counterEnabled;
    private int $counterValue;
    private int $orderValue;
    private int $idUsr;
    
    //db
    public function getVideoByIdVid(int $idVid): Array {   
        $sql = 'select id_vid as idVid, url, img, title, upload_date as uploadDate, 
            counter_enabled as counterEnabled, counter_value as counterValue, 
            order_value as orderValue, id_usr as idUsr from video where id_vid = :idVid';
        $params = ['idVid' => $idVid];
        //placeholder parameters for constructor
        $ctor_args= [0, '', '', '', '', '', 0, 0, 0];

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

    public function getVideoByIdUsr(int $idUsr): Array {   
        $sql = 'select id_vid as idVid, url, img, title, upload_date as uploadDate, 
            counter_enabled as counterEnabled, counter_value as counterValue, 
            order_value as orderValue, id_usr as idUsr from video where id_usr = :idUsr';
        $params = ['idUsr' => $idUsr];
        //placeholder parameters for constructor
        $ctor_args= [0, '', '', '', '', '', 0, 0, 0];

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
        int $counterValue, int $orderValue, int $idUsr): bool {
        
        $sql = 'insert into video (url, img, title, upload_date, 
            counter_enabled, counter_value, order_value, id_usr) values (:url, :img, :title, 
            SYSDATE(), :counterEnabled, :counterValue, :orderValue, :idUsr)';
        $params = [
            'url' => $url, 
            'img' => $img, 
            'title' => $title, 
            //uploadDate ------> SYSDATE()
            'counterEnabled' => false, 
            'counterValue' => 0,
            'orderValue' => 0,
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
        int $counterValue, int $orderValue, int $idUsr) {
        
        $this->idVid = $idVid;
        $this->url = $url;
        $this->img = $img;
        $this->title = $title;
        $this->uploadDate = $uploadDate;
        $this->counterEnabled = $counterEnabled;
        $this->counterValue = $counterValue;
        $this->orderValue = $orderValue;
        $this->idUsr = $idUsr;
    }

    //factory
    public static function factory() : Video {
        return new Video(0, '', '', '', '', false, 0 ,0, 0);
    } 

    //setter getter
    public function setIdVid(int $idVid): bool { 
        $this->idVid = $idVid; 

        $sql = 'update video set id_vid = :newIdVid where id_vid = :idVid';
        $params = [
            'newIdVid' => $idVid,
            'idVid' => $this->idVid]; 
     
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
    public function getIdVid(): int { 
        return $this->idVid;
    }

    public function setUrl(string $url): bool { 
        $this->url = $url; 

        $sql = 'update video set url = :url where id_vid = :idVid';
        $params = [
            'url' => $url,
            'idVid' => $this->idVid]; 
     
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
    public function getUrl(): string { 
        return $this->url; 
    }

    public function setImg(string $img): bool { 
        $this->img = $img; 

        $sql = 'update video set img = :img where id_vid = :idVid';
        $params = [
            'img' => $img,
            'idVid' => $this->idVid]; 
     
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
    public function getImg() { 
        return $this->img; 
    }

    public function setTitle(string $title): bool { 
        $this->title = $title; 

        $sql = 'update video set title = :title where id_vid = :idVid';
        $params = [
            'title' => $title,
            'idVid' => $this->idVid]; 
     
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
    public function getTitle(): string { 
        return $this->title; 
    }

    public function setUploadDate(string $uploadDate): bool { 
        $this->uploadDate = $uploadDate; 

        $sql = 'update video set upload_date = :uploadDate where id_vid = :idVid';
        $params = [
            'uploadDate' => $uploadDate,
            'idVid' => $this->idVid]; 
     
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
    public function getUploadDate(): string { 
        return $this->uploadDate; 
    }

    public function setCounterEnabled(bool $counterEnabled): bool { 
        $this->counterEnabled = $counterEnabled; 

        $sql = 'update video set counter_enabled = :counterEnabled where id_vid = :idVid';
        $params = [
            'counterEnabled' => $counterEnabled,
            'idVid' => $this->idVid]; 
     
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
    public function getCounterEnabled(): bool { 
        return $this->counterEnabled; 
    }

    public function setCounterValue(int $counterValue): bool { 
        $this->counterValue = $counterValue; 

        $sql = 'update video set counter_value = :counterValue where id_vid = :idVid';
        $params = [
            'counterValue' => $counterValue,
            'idVid' => $this->idVid]; 
     
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
    public function getCounterValue(): int { 
        return $this->counterValue; 
    }

    public function setOrderValue(int $orderValue): bool { 
        $this->orderValue = $orderValue; 

        $sql = 'update video set order_value = :orderValue where id_vid = :idVid';
        $params = [
            'orderValue' => $orderValue,
            'idVid' => $this->idVid]; 
     
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
    public function getOrderValue(): int { 
        return $this->orderValue; 
    }

    public function setIdUsr(int $idUsr): bool { 
        $this->idUsr = $idUsr; 

        $sql = 'update video set id_usr = :idUsr where id_vid = :idVid';
        $params = [
            'idUsr' => $idUsr,
            'idVid' => $this->idVid]; 
     
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
    public function getIdUsr(): int { 
        return $this->idUsr; 
    }
}
?>
