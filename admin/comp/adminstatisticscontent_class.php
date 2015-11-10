<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 02.04.2015
 * Time: 23:05
 */
require_once "adminmodules_class.php";

class AdminStatisticsContent extends AdminModules{

    protected $title = "Статистика";
    protected $meta_desc = "Аккаунт администратора Интернет-магазина";
    protected $meta_key = "администратор";


    protected function getContent(){

        return "index";

    }

}