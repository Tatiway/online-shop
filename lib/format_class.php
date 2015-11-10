<?php
require_once 'config_class.php';
//вспомпгптнльные классы для работы с временем и проверка данных на валидность
class Format {

    private $config;


    public function __construct(){
        $this->config = new Config();
    }

    //возращает время в секундах прошедшее с январа 1997 года
    public function ts(){
        return time();
    }

    //входные данные проходят через этот метод, для проверки валидности данных
    //все данные полученные из форм из get параметров будут проходить проверку;
    public function xss($data){
        if(is_array($data)){
            $escaped = array();
            foreach ($data as $key => $value){
                $escaped[$key] = $this->xss($value);
            }
            return $escaped;
        }
        return htmlspecialchars($data);
    }

    public function hash($str){
        return md5($str.$this->config->secret);
    }





}

//$format = new Format();
//echo $format->ts();
//echo "<br>";
//$data = array (1,3,5,6, "ckjdj", array(6, "ckjdj"));
//print_r($data);
//echo "<br>";
//print_r ($format->xss( '[name]=>"Борис" , [tel]=>"038958943"' ));