<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 26.02.2015
 * Time: 21:00
 */
require_once 'config_class.php';
//занимается проверкой входных данных
class Check {

    private $config;

    public function __construct(){
        $this->config = new Config();
    }
    //проверка на корректоность id, $zero = false-по умолчанию id не может быть нулевым, если поставить (0, true)-то id=0 разрешается,если поставить просто (0), то не разрешется
    // проверка идет на целочисленное значение
    public function id($id, $zero = false){
        if(!$this->intNumber($id)) return false;//проверка что число целое
        if((!$zero) && ($id === 0 )) return false;
        return $id >= 0;
    }
    //проверка данных введенных в форму

    public function ids($ids){
        $reg = "/^\d+(,\d+)*\d?$/i";
        return preg_match($reg, $ids);
    }

    public function amount($amount){
        if(!$this->doubleNumber($amount))return false;
        return $amount >= 0;
    }
    private function doubleNumber($number){
        return is_numeric($number);
    }
    public function name($name){
        if($this->isContainQuotes($name)) return false;
        return $this->isString($name, 1 ,$this->config->max_name);
    }

    private function isContainQuotes($string){
        $array = array("\"", "'", "`","&quot;", "&apos;");
        foreach ($array as $value) {
            if(strpos($string, $value) !== false)return true;
        }
        return false;
    }

    private function isString($string, $min_length, $max_length){
        if(!is_string($string)) return false;
        if(strlen($string) < $min_length) return false;
        if(strlen($string) > $max_length) return false;
        return true;
    }

    public function title($title){
        return $this->isString($title, 1, $this->config->max_title);

    }

    public function phone($phone){
        if($this->isContainQuotes($phone)) return false;
        $reg = "/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i";
        return preg_match($reg, $phone);


    }

    public function email($email){
        if($this->isContainQuotes($email)) return false;
        $reg= "/^[a-z0-9][a-z0-9\._-]*[a-z0-9_]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+$/i";
        return preg_match($reg, $email);

    }
    public function text($text, $empty = false){
        if(($empty) && ($text==""))return true;
        return $this->isString($text, 1, $this->config->max_text);

    }
    public function ts($ts){
        return $this->noNegativeInteger($ts);


    }



    // проверка является ли чесло 0 или 1
    public function oneOrZero($number){
        if(!$this->intNumber($number))return false;
        return (($number == 0 )|| ($number == 1));
    }
    // проверяем передаваемы параметр, что он является целым числом
    //заменить на private
    public function intNumber($number){
        if(!is_int($number)&& !is_string($number))return false;//если не целое и не строковое, то возвращаем false
        return preg_match("/^\+?\d+$/", $number);//проверка на число

    }
    //count должен быть не неотрицательное число
    public function count($count){
        return $this->noNegativeInteger($count);

    }
    //offset- может быть отрицательным но обязательно целым числом
    public function offset($offset){
        return $this->intNumber($offset);

    }

    public function noNegativeInteger($number){
        if(!$this->intNumber ($number)) return false;// проверяем число ли это
        return ($number >= 0);// проверяем больше или равно 0;

    }



}

//$check = new Check();
//
//echo $check->name("&quot;");
//echo $check->oneOrZero(1);

//echo "не негативное ". $check->offset(-2);
//
//echo "0 или 1 = ". $check->oneOrZero(2.3);
//echo "<br>";
//echo "id = ". $check->id(0 );
//echo "<br>";
//echo "результат". $check->intNumber(-4);
//echo "<br>";
//echo "число ". !is_int("6.5");
//echo "<br>";
//echo "строка ". !is_string("6.5");
//echo "<br>";
//echo "рег выраж".preg_match("/^-?(([1-9][0-9]*)|(0))/", "56uiyuiy");