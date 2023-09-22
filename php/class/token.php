<?php
require_once __DIR__ . '/../dbConnection.php';
class Token {
    private int $idToken;
    private string $stringToken;
    private string $creationDate;
    private int $idUsr;

    //functions
    public function generateUniqueToken(): string {
        /*
            generate random hex 
            check if it exists in the db
        */       
        $isUnique = false;
        while(!isUnique){
            $auxStringToken = bin2hex(random_bytes(16));
            $auxArr = getTokenByStringToken($auxStringToken);
            if(count($auxArr) == 0){
                $isUnique = true;       
            }
        }
        return $auxStringToken;
    }

    //db
    public function getTokenByIdToken(int $idToken): Array {   
        $sql = 'id_token as idToken, string_token as stringToken, 
            creation_date as creationDate, id_usr as idUsr 
            from token where idToken = :idToken';
        $params = ['idToken' => $idToken];
        //placeholder parameters for constructor
        $ctor_args= [0, '', '', 0];

        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stm->execute($params);
            return $stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Token', $ctor_args);
        } catch(PDOException $e) { 
            echo $e->getMessage();
            return Array();
        } 
	}

    public function getTokenByStringToken(int $stringToken): Array {   
        $sql = 'id_token as idToken, string_token as stringToken, 
            creation_date as creationDate, id_usr as idUsr 
            from token where stringToken = :stringToken';
        $params = ['stringToken' => $stringToken];
        //placeholder parameters for constructor
        $ctor_args= [0, '', '', 0];

        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stm->execute($params);
            return $stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Token', $ctor_args);
        } catch(PDOException $e) { 
            echo $e->getMessage();
            return Array();
        } 
	}

    public function getTokenByIdUsr(int $idUsr): Array {   
        $sql = 'id_token as idToken, string_token as stringToken, 
            creation_date as creationDate, id_usr as idUsr 
            from token where idUsr = :idUsr';
        $params = ['idUsr' => $idUsr];
        //placeholder parameters for constructor
        $ctor_args= [0, '', '', 0];

        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stm->execute($params);
            return $stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Token', $ctor_args);
        } catch(PDOException $e) { 
            echo $e->getMessage();
            return Array();
        } 
	}

    public function insert(int $idToken, string $stringToken, 
        string $creationDate, int $idUsr): bool {
        
        $sql = 'insert into token (string_token, creation_date, id_usr) 
            values (:stringToken, :creationDate, :idUsr)';
        $params = [
            'stringToken' => $stringToken, 
            'creationDate' => $creationDate, 
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
        $sql = 'delete from token where id_token = :idToken';
        $params = ['idToken' => $this->idToken]; 
     
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
    public function __construct(int $idToken, string $stringToken, 
        string $creationDate, int $idUsr) {
        
        $this->idToken = $idToken;
        $this->stringToken = $stringToken;
        $this->creationDate = $creationDate;
        $this->idUsr = $idUsr;
    }

    //factory
    public static function factory() : Video {
        return new Video(0, '', '', 0);
    } 

    //setter getter
    function setIdToken(int $idToken): bool { 
        $this->idToken = $idToken; 

        $sql = 'update token set id_token = :idNewToken where id_token = :idToken';
        $params = [
            'idNewToken' => $idToken,
            'idToken' => $this->idToken]; 
     
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
    function getIdToken(): int { 
        return $this->idToken; 
    }

    function setStringToken(string $stringToken): bool { 
        $this->stringToken = $stringToken; 

        $sql = 'update token set string_token = :stringToken where id_token = :idToken';
        $params = [
            'stringToken' => $stringToken,
            'idToken' => $this->idToken]; 
     
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
    function getStringToken(): string { 
        return $this->stringToken; 
    }

    function setCreationDate(string $creationDate): bool { 
        $this->creationDate = $creationDate;

        $sql = 'update token set creation_date = :creationDate where id_token = :idToken';
        $params = [
            'creationDate' => $creationDate,
            'idToken' => $this->idToken]; 
     
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
    function getCreationDate(): string { 
        return $this->creationDate; 
    }
    
    function setIdUsr(int $idUsr): bool { 
        $this->idUsr = $idUsr; 

        $sql = 'update token set id_usr = :idUsr where id_token = :idToken';
        $params = [
            'idUsr' => $idUsr,
            'idToken' => $this->idToken]; 
     
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
    function getIdUsr(): int { 
        return $this->idUsr; 
    }
}
?>
