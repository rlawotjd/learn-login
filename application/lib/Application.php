<?php

namespace application\lib;

use application\util\UrlUtil;
class Application{
    //생성자
    public function __construct()
    {
        $arrPath = UrlUtil::getUrlArrPath();//접속 URL 배열로 받음

        $identityName = empty($arrPath[0])?"User":ucfirst($arrPath[0]);
        $action= (empty($arrPath[1])?"login":$arrPath[1]).ucfirst(strtolower($_SERVER["REQUEST_METHOD"])); //todo
        // var_dump($_SERVER["REQUEST_METHOD"]);
        $controllerPath = _PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER._EXTENSION_PHP;

        if(!file_exists($controllerPath)){
            echo "Not Founded. :".$controllerPath;
            exit();
        }

        $controllerName=UrlUtil::replaceSlashToBackslash(_PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER);
        
        new $controllerName($identityName,$action);
        
        // var_dump($controllerName);
        // var_dump($arrPath);
        // var_dump($identityName);
        // var_dump($action);
        exit();
    }

}