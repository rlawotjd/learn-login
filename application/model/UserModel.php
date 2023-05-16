<?php
namespace application\model;

class UserModel extends Model
{
    public function getUser($arrUserInfo,$pwFlg = true)
    {
        $sql = " select "
        ." * "
        ." from "
        ." user_info "
        ." where "
        ." u_id = :id "
        ;
        if ($pwFlg) {
            $sql.=" and u_pw = :pw ";
        }
        
        $prepare = [
            ":id" => $arrUserInfo["id"]

        ];
        if ($pwFlg) {
            $prepare[":pw"]= $arrUserInfo["pw"];
        }
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($prepare);
            $result = $stmt->fetchAll();

        } catch (Exception $e) {
            echo "UserModel->getUser Error :".$e->getMessage();
            exit();
        }

        return $result;
    }
    //insert user
    public function insertUser($arrUserInfo)
    {
        $sql = 
        " INSERT INTO "
        ." user_info "
        ." ( "
        ." u_id "
        ." , u_pw "
        ." , u_name "
        ." ) "
        ." SELECT "
        ." :id "
        ." , :pw "
        ." , :name "
        ." FROM DUAL "
        ." WHERE NOT EXISTS "
        ." (SELECT "
        ." u_id "
        ." FROM "
        ." user_info "
        ." WHERE "
        ." u_id = :id "
        ." ) "
        ;
        // $sql = 
        // " INSERT INTO "
        // ." user_info "
        // ." ( "
        // ." u_id "
        // ." ,u_pw "
        // ." ,u_name "
        // ." ) "
        // ." VALUES "
        // ." ( "
        // ." :id "
        // ." ,:pw "
        // ." ,:name "
        // ." ) "
        // ;
        $prepare=[
            ":id"=>$arrUserInfo["id"]
            ,":pw"=>$arrUserInfo["pw"]
            ,":name"=>$arrUserInfo["name"]
        ];
        try {
            $stmt = $this->conn->prepare($sql);
            $result=$stmt->execute($prepare);
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }
}