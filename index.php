<?php

//config 파일 
require_once("application/lib/config.php"); //부를 때 에러 터지면 멈춤
require_once("application/lib/autoload.php"); //부를 때 에러 터지면 멈춤

// echo _ROOT;
// echo $_GET["url"];
new application\lib\Application();

?>