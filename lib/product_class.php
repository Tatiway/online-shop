<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 0:47
 */
require_once "global_class.php";
//обработка таблици с товрами

class Product extends GlobalClass{

    public function __construct(){
        parent::__construct("products");
    }

    public function getAllData($count){
        return $this->transform($this->getAll("date", false, $count  ) );
    }


    //проверка данных сортировки
    private function checkSortUp($sort, $up){
        return ((($sort === "title")||($sort === "price")) && (($up === "1")||($up === "0")) );
    }
    //вывод товаров по катигории и с возможностью сортировки по цене и пр.
    public function getAllOnCategoriesID($categories_id, $sort, $up){
        if(!$this->checkSortUp($sort, $up))return $this->transform($this->getAllOnField("catedories_id", $categories_id));
        return $this->transform($this->getAllOnField("catedories_id", $categories_id, $sort, $up));
    }

    //вывод сортированных товаров
    public function getAllDataSort($sort , $up, $count){
        if(!$this->checkSortUp($sort, $up))return $this->getAllData($count);//если проверка не пройдена,то ничего не сортируем
        //если все хорошо, то необходимо сформировать запрос
        $l=$this->getL($count,0);//данный метод возвращает - "LIMIT $count";
        $desc = "";
        if(!$up) $desc = "DESC";//
        //двойная сотрировка, сортируем только новинки отображонные на странице, запрос на сортировку будет такой
        $query = "SELECT * FROM
          (SELECT * FROM `".$this->table_name."`ORDER BY `date` DESC $l)as t
          ORDER BY `$sort` $desc";
        return $this->transform($this->db->select($query));

    }


    //альтернативный вывод информации о продукту
//    public function get($id){
//        if(!$this->check->id($id)) return false;
//        return $this->transform(parent::get($id));
//
//    }

    //вывод информации об одном продукте
    public function getProd($id, $cat_table){
        if(!$this->check->id($id)) return false;
        $query = "SELECT
            ".$this->table_name.".id,
            ".$this->table_name.".catedories_id,
            ".$this->table_name.".title,
            ".$this->table_name.".imgBig,
            ".$this->table_name.".price,
            ".$this->table_name.".description,
            ".$this->table_name.".sale,
            ".$this->table_name.".descriptionfull,
            ".$cat_table.".title as cat
            FROM ". $this->table_name."
            INNER JOIN ".$cat_table."
            ON ". $cat_table.".id = ".$this->table_name.".catedories_id
            WHERE ".$this->table_name.".id =".$this->config->sym_query;
        //echo $query;
        return $this->transform($this->db->selectRow($query, array($id)));

    }

    //вывод сопутствующих товаров

    public function getOthers($product_info, $count){
        $l = $this->getL($count, 0);
        $query ="SELECT * FROM ".$this->table_name." WHERE catedories_id = ".$this->config->sym_query." AND id != ".$this->config->sym_query." ORDER BY RAND () $l";
        return $this->transform($this->db->select($query, array($product_info['catedories_id'],$product_info['id'] ) ));
    }
    // получаем данные по известным множественным id
    //$query = SELECT * FROM shop_products WHERE id IN ({?}, {?}, {?} );

    public function getAllOnIDs($ids){

        $query_ids = "";
        $params = array();
        for($i = 0; $i<count($ids); $i++){
            $query_ids .=$this->config->sym_query.",";
            $params[]=$ids[$i];
        }
        $query_ids = substr($query_ids , 0, -1);
        $query = "SELECT * FROM ". $this->table_name ." WHERE id IN ($query_ids)";
        //echo $query;
        return $this->transform($this->db->select($query, $params));

    }
    //запрос в базу данных на стоимость товаров занесеных в базу
    //и рвсчет и вывод суммы заказанных товаров
    public function getPriceOnIDs($ids){
        $products = $this->getAllOnIDs($ids);
        $result = array();
        for($i = 0; $i <count($products); $i++){
            $result[$products[$i]["id"]]=$products[$i]["price"];
        }
        $summa = 0;
        for($i = 0; $i<count($ids); $i++){
            $summa +=$result[$ids[$i]];
        }
        return $summa;

    }

    protected function transformElement($product){
        $product['img']=$this->config->dir_img_products.$product['img'];
        $product['imgBig']=$this->config->dir_img_products.$product['imgBig'];
        $product['imgSmall']=$this->config->dir_img_products.$product['imgSmall'];
        $product['link'] = $this->url->product($product["id"]);
        $product['link_cart'] = $this->url->addCart($product["id"]);
        $product['link_delete'] = $this->url->deleteCart($product["id"]);
        return $product;

    }

    public function searches($q,$sort, $up){
        if(!$this->checkSortUp($sort, $up))return $this->getAllData(parent::search($q, array("title", "description")));
        return $this->transform(parent::search($q, array("title", "description"),$sort, $up));

    }






}

