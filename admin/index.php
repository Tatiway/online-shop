<?php

//шаблонизатор вывод страниц
require_once "start.php";

require_once "url_class.php";

$url = new Url();
//опеделяет какой класс нам нужен
$view = $url->getView();


$class = mb_strtolower("admin".$_GET["view"]."Content");

if($url->fileExists($class."_class.php")){
    require_once $class."_class.php";
    new $class();

} else {
    echo $class;
    //header("Location: ".$url->notfound());
    exit;
}

