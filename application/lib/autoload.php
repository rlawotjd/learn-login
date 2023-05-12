<?php

spl_autoload_register(
    function ($path)
    {
        $path = str_replace("\\","/",$path); // "\"을 "/"로 변경
        // $arr_path = explode("/",$path); // "/"익스플로드

        // //각 디렉토리 분류
        // echo $path."php";
        
        //해당 디렉토리 부름
        require_once($path._EXTENSION_PHP); 
    }
);