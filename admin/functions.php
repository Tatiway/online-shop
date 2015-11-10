<?php
require_once "start.php";
session_start();

require_once "manageadmin_class.php";
require_once "urladmin_class.php";
require_once "auth_class.php";

$manage = new ManageAdmin();
$url = new UrlAdmin();
$auth = new Auth();
$func = $_REQUEST["func"];

if($func == "auth"){
    $link = $manage->auth();
}
else if(!$auth->checkAdmin($_SESSION["login"], $_SESSION["password"])) {
    header("Location: ".$url->auth());
    exit;
}
else {
    if($func == "logout"){
        $manage->logout();

    }
    else exit;
}

if (!$link) $link = ($_SERVER["HTTP_REFERER"] != "")? $_SERVER["HTTP_REFERER"]: $url->index();
header("Location: $link");
exit;

