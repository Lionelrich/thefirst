<?php
require "../conf.php";
require "../vendor/autoload.php";
function view($view, $params){
    extract($params);
    include APP_DIR."/app/Views/".$view.".phtml";
    exit;
}
$path=explode("/", trim($_SERVER["REDIRECT_URL"], "/"));
$namespace="\App\Controllers\\".ucfirst($path[0]);
$controller=new $namespace;
$controller->{$path[1]}();
