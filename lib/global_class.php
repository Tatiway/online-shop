<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 0:09
 */

require_once "database_class.php";
require_once "config_class.php";
require_once "check_class.php";
require_once "format_class.php";
require_once "url_class.php";
require_once "systemmessage_class.php";

abstract class GlobalClass {

    protected $db;
    protected $table_name;
    protected $format;
    protected $config;
    protected $check;
    protected $url;

    public function __construct($table_name){
        $this->db =  DataBase::getDB();
        $this->format  = new Format();
        $this->config = new Config();
        $this->check = new Check();
        $this->url = new Url();
        $this->table_name = $this->config->db_prefix.$table_name;//определяем полное название таблицы
    }

    //добавляем данные в базу
    public function add($data){
        if(!$this->check($data)) return false;//если проверка не проходит
        $query = "INSERT INTO ".$this->table_name." ( ";
        foreach( $data as $field => $value) $query .="$field ,";
        $query = substr($query ,0 ,-1);
        $query .= ") VALUES (";
        foreach ($data as $value ) $query .= $this->config->sym_query. " ,";
        $query = substr($query ,0 ,-1);
        $query .= " )";
        //echo $query;
        //print_r(array_values($data));
        return $this->db->query($query,  array_values($data));

    }
    // вывод системных сообщений
    private function check($data){
        $result = $this->checkData($data);// вкаждом классе checkData свой
        //echo $result;
        //если все хорошо попадаем суда
        if($result === true) return true;
        //создаем объект класса SystemMessage()в этом методе потомучто он нужен только сдесь
        //если все плохо
        $sm = new SystemMessage();

        return $sm->message($result);

    }
    protected function checkData($data){//если мы не сделали эту проверку, то данные добавлять не имеем права
        return false;
    }

    //проверка существует ли такой id в базе данных
    public function existsID($id){
        if(!$this->check->id($id))return false;
        return $this->isExistsFV( "id", $id );
    }
    //метод делает запрос на получение данных по известному полю и его значению, возвращает количество палей с таким значением не равное 0;
    protected function isExistsFV($field, $value){
        $result = $this->getAllOnField($field, $value);
        return count($result)!= 0;

    }

    //получаем все поля $order = false-сортировка, $up = true-по возрастанию, по убыванию, $count = false - количество элементов, $offset = false-смещение
    protected function getAll($order = false,$up = true, $count = false, $offset = false){
        $ol = $this->getOL($order, $up, $count, $offset);
        $query = "SELECT * FROM `".$this->table_name. "`$ol";
        return $this->db->select($query);
    }

    public function get($id){
        if(!$this->check->id($id)) return false;
        return $this->getOnField("id", $id);

    }
    //получить один ивестный параметр по известному полю и его значению
    public function getField($field_in, $value_in, $field_out ){
        $query = "SELECT $field_out FROM ".$this->table_name. " WHERE $field_in = ".$this->config->sym_query;
        return $this->db->selectCell($query,array($value_in));


    }
    //получить данные одной строки по изветному полю и его значению ( например email = tattiway@mail.ru)
    protected function getOnField($field, $value){
        $query = "SELECT * FROM `".$this->table_name."`WHERE `$field` = ". $this->config->sym_query;
        return $this->db->selectRow($query, array($value));
    }

    //запрос на получение полей с указанным параметром $field-имя столбца, $value-его значение, например ("title", "Планшеты");
    protected function getAllOnField($field, $value, $order = false,$up = true, $count= false, $offset = false){
        $ol = $this->getOL($order, $up, $count, $offset);
        $query = "SELECT * FROM `".$this->table_name."`WHERE `$field` = ".$this->config->sym_query."  $ol";
        return $this->db->select($query, array($value));
    }
    // устанавливает ORDER BY по какому параметру будет сортировка
    protected function getOL($order, $up, $count, $offset){
        if($order){
            $order = "ORDER BY `$order`";
            if(!$up) $order.=" DESC";
        }
        $limit = $this->getL($count, $offset);
        return "$order $limit";
    }
// протектед метод проверяет и устанавливает LIMIT выводимых записей LIMIT (c кокой),(количество записей) или LIMIT 8;
    protected function getL($count, $offset){

        $limit = "";

        if($count){
            if(!$this->check->count($count)) return false;
            if($offset){
                if(!$this->check->offset($offset)) return false;
                $limit = "LIMIT $offset, $count";
            }
            else $limit = "LIMIT $count";
        }
        return $limit;

    }

    public function search($q, $fields, $order = false, $up = false){
        if(count($fields)== 0 )return false;
        $q = trim($q);
        if($q === "")return false;
        $q = preg_replace("/\s+/", " ",$q);
        $q = mb_strtolower($q);
        $array_words = explode(" ",$q);
        $logic = " AND ";
        $params = array();
        $where = "";
        foreach($array_words as $key => $value){
            if(isset($array_words[$key - 1])) $where .= $logic;
            for($i = 0; $i <count($fields); $i++){
                $where .= $fields[$i]." LIKE ".$this->config->sym_query;
                $params[]="%$value%";
                if(($i + 1) != count($fields)) $where .= " OR ";
            }
        }
        $ol = $this->getOL($order, $up, 0, 0);
        $query = " SELECT * FROM ".$this->table_name. " WHERE $where $ol";
       //echo $query;
        return $this->db->select($query, $params);


    }

    public function getTableName(){
        return $this->table_name;
    }

    protected function transform($element){
        if(!$element)return false;
        if(isset($element[0])){//тоесть существует массив
            for ($i = 0; $i < count($element); $i++)
                $element[$i] = $this->transformElement($element[$i]);// метод возврыщаеи $emement[$i] =  Array ([0] => Array ( [id] => 1 [title] => Ноутбуки [link] => Сылка на странитцу1
            return $element;
        }
        else return $this->transformElement($element);


    }



}

//$global = new GlobalClass("products");
////
//$result = $global->getAllOnField("id", 2);
//print_r($result);
//
//$result = $global->getOL("id", false, 5,6);
//print_r($result);