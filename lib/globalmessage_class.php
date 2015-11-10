<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 26.02.2015
 * Time: 21:12
 */
require_once 'config_class.php';
//класс для работы с сообщениями

abstract class GlobalMessage {

    private $data;

    public function __construct($file){
        $config = new Config();
        $this->data = parse_ini_file($config->dir_text.$file.".ini");

    }

    public function get($name){
        return $this->data[$name];

    }


}