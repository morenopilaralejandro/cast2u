<?php
require_once __DIR__ . '/../dbConnection.php';
class Usr {
    private int $idUsr;
    private string $usrName;
    private string $pwd;
    private string $email;

    //db
    public function getUsrByIdUsr(int $idUsr): Array {   
        $sql = 'select id_usr as idUsr, usr_name as usrName, pwd, email 
            from usr where id_usr = :idUsr';
        $params = ['idUsr' => $idUsr];
        //placeholder parameters for constructor
        $ctor_args= [0, '', '', ''];

        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stm->execute($params);
            return $stm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Usr', $ctor_args);
        } catch(PDOException $e) { 
            echo $e->getMessage();
            return Array();
        } 
	}

    public function insert(int $idUsr, string $usrName, 
        string $pwd, string $email): bool {
        
        $sql = 'insert into usr (usr_name, pwd, email) 
            values (:usrName, :pwd, :email)';
        $params = [
            'usrName' => $usrName, 
            'pwd' => $pwd, 
            'email' => $email]; 
     
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
        $sql = 'delete from usr where id_usr = :idUsr';
        $params = ['idUsr' => $this->idUsr]; 
     
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
        
        $this->idUsr=$idUsr;
        $this->usrName=$usrName;
        $this->pwd=$pwd;
        $this->email=$email;
    }

    //factory
    public static function factory() : Usr {
        return new Usr(0, '', '', '');
    } 

    //setter getter
    public function setIdUsr(int $idUsr): bool { 
        $this->idUsr = $idUsr; 

        $sql = 'update usr set id_usr = :newIdUsr where id_usr = :idUsr';
        $params = [
            'newIdUsr' => $idUsr,
            'idUsr' => $this->idUsr]; 
     
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

    public function setUsrName(string $usrName): bool { 
        $this->usrName = $usrName; 

        $sql = 'update usr set usr_name = :usrName where id_usr = :idUsr';
        $params = [
            'usrName' => $usrName,
            'idUsr' => $this->idUsr]; 
     
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
    public function getUsrName(): string { 
        return $this->usrName;
    }

    public function setPwd(string $pwd): bool { 
        $this->pwd = $pwd;

        $sql = 'update usr set pwd = :pwd where id_usr = :idUsr';
        $params = [
            'pwd' => $pwd,
            'idUsr' => $this->idUsr]; 
     
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
    public function getPwd(): string { 
        return $this->pwd; 
    }

    public function setEmail(string $email): bool { 
        $this->email = $email; 

        $sql = 'update usr set email = :email where id_usr = :idUsr';
        $params = [
            'email' => $email,
            'idUsr' => $this->idUsr]; 
     
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
    public function getEmail(): string { 
        return $this->email; 
    }
}
?>
