<?php
require_once('dbConnection.php');
class DbFun {

    //video
	public function getVidById(int $idVid, int $idUsr): Array {   
        $sql = 'select * from video 
            where id_vid = :idVid and id_usr=:idUsr';
        $params = [ 
                'idVid' => $idVid, 
                'idUsr' => $idUsr];

        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                
            $stm->execute($params);
            return $stm->fetchAll();
            
        } catch(PDOException $e) { 
            echo 'getVidById ' . $e->getMessage();
            return Array();
        } 
	}

    public function getVidByUser(int $idUsr): Array {
        $sql = 'select * from video where id_usr=:idUsr';
        $params = ['idUsr' => $idUsr];

        $con = new DbConnection();
        $link = $con->getConnection();
        try{ 
            $stm = $link->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stm->execute($params);
            return $stm->fetchAll();
        } catch(PDOException $e) { 
            echo 'getVidById ' . $e->getMessage();
            return Array();
        } 
		return $res;
	}

    public function insertVid(string $url, string $img, string $title, string $uploadDate, 
        bool $counterEnabled, int $counterValue, int $idUsr) : bool {

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
            echo 'getVidById ' . $e->getMessage();
            return false;
        } 
    }  

    public function updateVid($id_vid, $title, $img, $url, $idUsr, $bd) {
        $sql = "update video set title='".$title."', img='".$img."', url='".$url."'";
        $sql.= " where id_vid=".$id_vid." and id_usr=".$idUsr;
		return updateDb($sql,$bd);
    }   

    public function deleteVid($id_vid, $idUsr, $bd) {
        $sql = "delete from video where id_vid=".$id_vid." and id_usr=".$idUsr;
		return updateDb($sql,$bd);
    } 

    //token
    public function getTokenById($idUsr, $bd) {
        return fetchDb("select string_token from token where id_usr=".$idUsr, $bd);
    }

    public function getTokenByString($strToken,$bd) {
        $result = fetchDb("select id_usr from token where string_token='".$strToken."'", $bd);;
        if(count($result)>0){
            return $result[0]->id_usr;
        }else{
            return -1;
        }      
    }

    public function insertToken($strToken, $idUsr, $bd) {
        return updateDb("insert into token (string_token, id_usr) values ('".$token."',".$idUsr.")", $bd);
    }
    
    public function updateToken($strToken, $idUsr, $bd) {
        return updateDb("update token set string_token='".$token."' where id_usr=".$idUsr, $bd);
    }


    public function deleteToken($idUsr, $bd) {
        $sql = "delete from token where id_usr=".$idUsr;
		return updateDb($sql,$bd);
    } 

    //usr
    public function insertUsr($username, $passEnc ,$bd) {
        $sql = "insert into usr (usr_name, pwd, email) VALUES ('".$username."','".$passEnc."','"."eeee"."')";
        return updateDb($sql, $bd);
    }

    public function getUsrByName($username, $bd) {
        return fetchDb("select * from usr where usr_name='".$username."'", $bd);
    }
    
    public function getUsrById($idUsr, $bd) {
        return fetchDb("select * from usr where id_usr=".$idUsr, $bd);
    }

    public function deleteUsr($idUsr, $bd) {
        $sql = "delete from usr where id_usr=".$idUsr;
		return updateDb($sql,$bd);
    } 
}
?> 
