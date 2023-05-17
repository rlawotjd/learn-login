<?php

namespace application\controller;

class UserController extends Controller 
{
    public function loginGet()
    {
        return "login"._EXTENSION_PHP;
    }
    public function loginPost()
    {
        $result = $this->model->getUser($_POST);
        $this->model->close();
        // 유저 유무 체크
        if (count($result)===0) {
            $errMsg="입력하신 회원 정보가 없습니다.";
            $this->addDynamicProperty("errMsg",$errMsg);
            //로그인 페이지 리턴
            return "login"._EXTENSION_PHP;

        }
        $_SESSION[_STR_LOGIN_ID] = $_POST["id"];


        return _BASE_REDIRECT."/product/list";
    }

    //로그아웃 메소드
    public function logoutGet()
    {
        session_unset();
        session_destroy();

        return "login"._EXTENSION_PHP;
    }
    //회원가입 이동 메소드
    public function regisGet()
    {
        return "regis"._EXTENSION_PHP;
    }
    // 회원가입
    public function regisPost()
    {
        $arrPost=$_POST;
        $arrChkErr = [];
        //유효성 체크
        if (mb_strlen($arrPost["id"])>12||mb_strlen($arrPost["id"])===0) {
            $arrChkErr["id"]="ID는 12글자 이하로 입력해주세요";
        }
        $patten="/[^a-zA-Z0-9]/"; //영어숫자대문자 아닌걸 찾아라
        if (preg_match($patten,$arrPost["id"])!==0) {
            $arrChkErr["id"]="ID는 영어대소문자,숫자로 입력해주세요";
        }
        if (mb_strlen($arrPost["pw"])>20||mb_strlen($arrPost["pw"])<8) {
            $arrChkErr["pw"]="PW는 8글자 이상 20글자 이하로 입력해주세요";
        }
        if ($arrPost["pw"]!==$arrPost["pwChk"]) {
            $arrChkErr["pwChk"]="비밀번호와 일치하지 않습니다.";
        }
        if (mb_strlen($arrPost["name"])>30||mb_strlen($arrPost["name"])===0) {
            $arrChkErr["name"]="담당자한테 문의해주세요";
        }
        //유효성 체크 에러일 경우
        if (!empty($arrChkErr)) {
            //에러메서지 셋팅
            $this->addDynamicProperty('arrError',$arrChkErr);
            return "regis"._EXTENSION_PHP;
        }
        $result=$this->model->getUser($arrPost,false);
         // 유저 유무 체크
        if (count($result)!==0) {
            $errMsg="입력하신 ID가 사용중입니다.";
            $this->addDynamicProperty("errMsg",$errMsg);
            //회원가입 페이지 리턴
            return "regis"._EXTENSION_PHP;

        }
        //transaction start
        $this->model->beginTransaction();
        //user insert
        if (!$this->model->insertUser($arrPost)) {
            echo "User Regis Error";
            $this->model->rollback();//예외처리
            exit();
        }
        $this->model->commit();//정상처리
        //transaction end
        
        //로그인 페이지로 이동
        return "login"._EXTENSION_PHP;
    }
}