<?php

require_once "lib/abstractmodules_class.php";
require_once "lib/urlAdmin_class.php";
require_once "lib/auth_class.php";



 abstract class AdminModules extends AbstractModules {

     protected $url_admin;

    //$сheck_auth = true - передаем, этот параметр это говорит о том, что всегда должны проходит авторизацию
     public function __construct($сheck_auth = true){
         parent::__construct();

         $this->url_admin = new URLAdmin();
         $auth = $this->checkAuth();
         if($сheck_auth && !$auth) $this->redirectAuth();

         $this->setMenu();
         $this->template->set("auth",$auth);
         $this->template->set("content", $this->getContent());
         $this->template->set("message",$this->message());
         $this->template->set("action", $this->url_admin->actions());
         $this->template->set("title", $this->title);
         $this->template->set("meta_desc", $this->meta_desc);
         $this->template->set("meta_key", $this->meta_key);
         $this->template->display("main");


     }

     private function setMenu(){
         $this->template->set("index",$this->url_admin->index());
         $this->template->set("link_products",$this->url_admin->products());
         $this->template->set("link_orders",$this->url_admin->orders());
         $this->template->set("link_sections",$this->url_admin->sections());
         $this->template->set("link_discounts",$this->url_admin->discounts());
         $this->template->set("link_statistics",$this->url_admin->statistics());
         $this->template->set("logout",$this->url_admin->logout());

     }

     private function checkAuth(){
         $auth = new Auth();
         return $auth->checkAdmin($_SESSION['login'], $_SESSION['password']);
     }

     private function redirectAuth(){
         $this->redirect($this->url_admin->auth());
     }

     protected function getDirTmpl(){
        return $this->config->dir_tmpl_admin;

     }


}