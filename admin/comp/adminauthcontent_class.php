<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 01.04.2015
 * Time: 16:57
 */

require_once "adminmodules_class.php";

class AdminAuthContent extends AdminModules {

    protected $title = "Вход в аккаунт";
    protected $meta_desc = " Вход аккаунт администратора Интернет-магазина";
    protected $meta_key = "вход в админ панель, аккаунт администратора";


    public function __construct(){
        parent::__construct(false);
    }

    protected function getContent(){
        if($this->template->auth) $this->redirect($this->url_admin->index());
        if($_SERVER["HTTP_REFERER"]!= $this->url_admin->getThisURL()){
            if($_SERVER["HTTP_REFERER"] != $this->url_admin->action()){
                $_SESSION["r"]= $_SERVER["HTTP_REFERER"];
            }
        }
        $this->template->set("login",$_SESSION["login"]);
        $this->template->set("r",$_SESSION["r"]);
        return "auth";

    }


}