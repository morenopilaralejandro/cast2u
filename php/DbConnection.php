<?php
require_once('DbCredentials.php');
class DbConnection {
    private PDO $link;

    public function getConnection(): PDO {
        $cred = new DbCredentials(true);
        try{ 
            $this->link = new PDO( 
                'mysql:host='.$cred->getDbHost().';
                    dbname='.$cred->getDbName().';
                    charset=utf8mb4', 
                $cred->getDbUser(), 
                $cred->getDbPass(), 
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION) 
            ); 
        } catch(PDOException $e){ 
            echo 'connection error ' . $e->getMessage();
        } 
       return $this->link;
    }
}
?>
