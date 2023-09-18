<?php 
class DbCredentials {
    private string $isLocal;	
    private string $dbHost;
    private string $dbName;
    private string $dbUser;
    private string $dbPass;

    public function __construct($isLocal) {
        if($isLocal){
	        $this->isLocal = $isLocal; 
	        $this->dbHost = 'localhost'; 
	        $this->dbName = 'cast2u'; 
	        $this->dbUser = 'root'; 
	        $this->dbPass = ''; 
        }else{
	        $this->isLocal = $isLocal; 
	        $this->dbHost = ''; 
	        $this->dbName = ''; 
	        $this->dbUser = ''; 
	        $this->dbPass = ''; 	
        }
    }

    public function getIsLocal(): bool {
        return $this->isLocal;
    }

    public function getDbHost(): string {
        return $this->dbHost;
    }

    public function getDbName(): string {
        return $this->dbName;
    }

    public function getDbUser(): string {
        return $this->dbUser;
    }

    public function getDbPass(): string {
        return $this->dbPass;
    }
}
?> 
