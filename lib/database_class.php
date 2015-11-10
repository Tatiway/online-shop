<?php
require_once "config_class.php";

class DataBase {

    private static $db = null;//экземпляр объекта
    private $config;
    private $mysqli;

    //используем шаблон проектирования синглтон для подключения к базе данных
    // создание объекта new DataBase происходит один раз
    public static function getDB(){// получить экземпляр данного класса
        if(self::$db == null)self::$db = new DataBase();// если экземпляр данного класса  не создан
        return self::$db;// возвращаем экземпляр данного класса
    }

    private function __construct(){// конструктор отрабатывает один раз при вызове DataBase::getDB(); - в нашем случае он вызывается в GlobalClass
        $this->config = new Config();
        //создаем подключение к бд
        $this->mysqli = new mysqli($this->config->db_host, $this->config->db_user, $this->config->db_password , $this->config->db_name);
        //отправляем запрос для установления кодировки
        $this->mysqli->query("SET NAMES 'utf8'");
    }
    //преабразуем запрос делаем его безопастным
    private function getQuery($query, $params){
        if($params){
            for($i = 0; $i < count($params); $i++){
                $pos = strpos($query, $this->config->sym_query);
                $arg = "'".$this->mysqli->real_escape_string($params[$i])."'";
                $query = substr_replace($query, $arg, $pos, strlen($this->config->sym_query));
            }
        }
        //echo $query;
        return $query;
    }


    //выборка данных из таблицы
    public function select($query, $params = false){
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if(!$result_set)return false;
        return $this->resultSetToArray($result_set);
    }

    //пераброзуем выборку в 2-х мерный массив
    private function resultSetToArray($result_set){
        $array = array();
        while (($row = $result_set->fetch_assoc()) == true) {
            $array[]= $row;
        }
        return $array;
    }

    // выборка конкретной строки
    public function selectRow($query, $params = false){
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if($result_set->num_rows!= 1)return false;
        return $result_set->fetch_assoc();
}

    //выборка конкретной ячейки с какой-то записи
    public function selectCell($query, $params = false){
        $result_set = $this->mysqli->query($this->getQuery($query, $params));
        if((!$result_set) || ($result_set->num_rows != 1))return false;
        else{
            $arr = array_values($result_set->fetch_assoc());
            return $arr[0];
        }
    }
    // метод определяет какой был запрос  за запрос и был ли вобще (если запрос insert - вернет номер id последнего запроса, если не insert то true если запроса вобще нет -false)
    public function query($query, $params = false){
        $success = $this->mysqli->query($this->getQuery($query, $params));
        if($success){//есть запрос
            if($this->mysqli->insert_id === 0 )return true;//т.е mysqli->insert_id-возвращает номер id вставленной записи, если вернулся 0 значит это был не insert запрос, это был или delete или update )
            else return $this->mysqli->insert_id;// возвращаем id вставленной записи
        }
        else return false;//если запрос прошол не удачно

    }

    public function __destruct(){
        if($this->mysqli) $this->mysqli->close();
    }

}

//$data =  DataBase::getDB();
//
////$query = "SELECT {?} FROM {?}";
////$params = array("*", 'products');
//
//$query = "SELECT * FROM shop_products";
////$params = false;
////echo $data->getQuery($query , $params);
////$config = new Config();
//////создаем подключение к бд
////$mysqli = new mysqli($config->db_host, $config->db_user, $config->db_password , $config->db_name);
//
//
//print_r($data->select($query, $params = false));
////print_r( $result_set = $mysqli->query("SELECT * FROM shop_products "));
//echo"<br>";
//
//
//
////$i=1;
////while ( $i <= 3) {
////    print_r($result_set->fetch_assoc()).'<br>';
////    $i++;
////}
//
////while ( ($row = $result_set->fetch_assoc()) == false ) {
////    $array = array();
////    print_r( $array[] = $row .'<br>');
////
////}
