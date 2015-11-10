<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 02.04.2015
 * Time: 19:29
 */
require_once "manage_class.php";
require_once "urlAdmin_class.php";
require_once "auth_class.php";

class ManageAdmin extends Manage{


    private $url_admin;

    public function __construct(){
        parent::__construct();
        $this->url_admin = new URLAdmin();
    }

    public function auth(){
        $auth = new Auth();
        $_SESSION["login"] = $this->data["login"];
        $_SESSION["password"] = $this->format->hash($this->data["password"]);
        if($auth->checkAdmin($_SESSION["login"],$_SESSION["password"] )) return $this->data["r"];
        else return $this->sm->message("ERROR_AUTH");
    }

    public function logout(){
        unset($_SESSION["login"]);
        unset($_SESSION["password"]);
    }


}