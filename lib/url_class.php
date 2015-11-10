<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 26.02.2015
 * Time: 19:59
 */
require_once 'config_class.php';
//  в данном классе хронятся ссылки на стрпницы и перодразуютя ссылки с нужными параметрами
class URL {

    protected $config;
    protected $amp;
//$amp = true поумолчанию заменяет & на сущность '&amp;'-для валидности запроса
// но при редиректе такая замена не нужна и функция setAMP отключает преобразование
    public function __construct( $amp = true){
        $this->config  = new Config();
        $this->amp = $amp;
    }
    //высленяет из url адреса название класса с который нужно вывести
    public function getView(){
        $view = $_SERVER["REQUEST_URI"];// возвращает название страницы на ноторой ты находишся, например /classfora.php
        $view = substr($view, 1);// удаляем слешь
        if(($pos = strpos($view, "?")) !== false){
            $view = substr($view, 0 ,$pos);

        }
		//echo $view;
        return $view;

    }
// отменет замну & на сущность
    public function setAMP($amp){
        $this->amp = $amp;

    }

    //получаем полные адресс текщей страницы, например http://shop/lib/url_class.php
    public function getThisURL(){
        $uri = substr($_SERVER['REQUEST_URI'], 1);
        return $this->config->address.$uri;
    }

    //позволяет удалить не нужный get параметр, например $url->deleteGET( "http://shop/lib/url_class.php?id=4&a=5" , "id"); результат http://shop/lib/url_class.php?a=5
    // передаем $url=url и $param = не нужный параметр
    //заменить на private

    protected function deleteGET($url, $param){
        $res = $url;
        if(($p = strpos($res, "?"))!== false){//находим позицию знака ? в url
            $paramstr = substr($res , $p+1);// удаляем все до знака, возращается все после знака
            $params = explode("&" , $paramstr);// разбивает данныее через & , возвращает массив
            $paramsarr = array();

            foreach($params as $value){// пропускаем полученный массив через цикл
                $tmp = explode("=", $value);// и опять разбиваем через =, получем массив
                $paramsarr[$tmp[0]] = $tmp[1];
            }
            if(array_key_exists($param, $paramsarr)){
                unset($paramsarr[$param]);
                $res = substr( $res, 0, $p+1);
                foreach($paramsarr as $key => $value){
                    $str = $key;
                    if($value !== ""){
                        $str.= "=$value";
                    }
                    $res.="$str&";
                }
                 $res = substr($res, 0, -1);
            }
        }
        return $res;
    }
    //получаем ссылку на главную страницу
    public function index(){
        return $this->returnURL("");
    }
    public function message(){
        return $this->returnURL("message");
    }
    //полчаем ссылку на страницу с корзиной http://shop/cart
    public function cart(){
        return $this->returnURL("cart");
    }
    public function order(){
        return $this->returnURL("order");
    }
    public function action(){
        return $this->returnURL("functions.php");
    }
    public function delivery(){
        return $this->returnURL("delivery");
    }
    public function contacts(){
        return $this->returnURL("contacts");
    }

    public function search(){
        return $this->returnURL("search");
    }

    public function categories($id){
        return $this->returnURL("categories?id=$id");//http://shop/categories?id=4
    }

    public function product($id){
        return $this->returnURL("product?id=$id");
    }

    public function addCart($id){
        return $this->returnURL("functions.php?func=add_cart&id=$id");
    }
    public function deleteCart($id){
        return $this->returnURL("functions.php?func=delete_cart&id=$id");
    }
    public function notfound(){
        return $this->returnURL("notfound");
    }

    //ссылки для сортировки начало

    public function sortPriceUp(){
        return $this->sortOnField("price", 1);

    }
    public function sortTitleUp(){
        return $this->sortOnField("title", 1);
    }
    public function sortPriceDown(){
        return $this->sortOnField("price", 0);

    }
    public function sortTitleDown(){
        return $this->sortOnField("title", 0);
    }

    protected function sortOnField($field, $up){
        $this_url = $this->getThisURL();
        $this_url = $this->deleteGET($this_url, 'sort');
        $this_url = $this->deleteGET($this_url, 'up');
        if(strpos($this_url, "?")=== false) $url = $this->url."?sort=$field&up=$up";
        else $url=$this_url."&sort=$field&up=$up";
        return $this->returnURL($url);


    }
    //ссылки для сортировки конец

    //возвращает конкретный адресс который требуется для пользователя, например передаем $url = product, возвращает http://shop/product
    //где $url-это параметры страницы , например "categories?id=3", a $index = false - по умолчанию http://shop,

    protected function returnURL($url, $index = false){
        if(!$index) $index = $this->config->address;//по умолчанию http://shop
        if($url == "") return $index;
        if(strpos($url, $index) !== 0) $url = $index.$url;
        if($this->amp) $url = str_replace("&","&amp;", $url);
        return $url;
    }

    public function fileExists($file){
        $arr = explode(PATH_SEPARATOR, get_include_path());
        foreach ($arr as $val){
            if(file_exists($val."/".$file))return true;
        }
        return false;

    }


}
//
//$url = new Url();
//echo $res = $url->delivery();
//echo $url->getThisURL().'<br>';
//echo $_SERVER['REQUEST_URI'];
//echo '<br>';
//echo '<br>';
//echo $url->deleteGET( "http://shop/lib/url_class.php?id=4&a=5" , "id");echo '<br>';
//
////echo $url->returnURL( "" );
//echo '<br>';
//echo '<br>';
//echo '<br>';
//$res = "http://shop/lib/url_class.php?id=4&a=5";
//echo $p = strpos($res, "?")."<br>";
//echo $paramstr = substr($res , $p+1);
//
//print_r( $params = explode("&" , $paramstr));
//$paramsarr = array();