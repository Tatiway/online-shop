<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 04.03.2015
 * Time: 16:18
 */

class SystemMessage {

    public function __construct(){
        session_start();
    }
//выводится на тойже странице
    public function message($name, $result = false){
        if($name == "UNKNOWN_ERROR") return $this->unknownError();
        $_SESSION["message"]=$name;
        return $result;
    }
//выводится на другой странице
    public function pageMessage($name, $result = true){
        if($name == "UNKNOWN_ERROR") return $this->unknownError(true);
        $_SESSION["page_message"] = $name;
        return $result;
    }
// метод по выводу неизвестной ошибки
    public function unknownError($page=false){
        if($page) $_SESSION["page_message"] = "UNKNOWN_ERROR";
        else $_SESSION["message"]= "UNKNOWN_ERROR";
        return false;

    }


}