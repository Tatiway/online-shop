<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 0:49
 */

require_once "global_class.php";

class Categories extends GlobalClass {

    public function __construct(){
        parent::__construct("categories");
    }

    public function getAllData(){
        return $this->transform($this->getAll("id"));
    }

    //метод создает новый элемент в ассоциативном массиве и передает ему значение ввиде ссылки с id=чемуто
    public function transformElement($categories){
        $categories["link"] = $this->url->categories($categories["id"]);//http://shop/categories?id=4
        return $categories;

    }

    public function getTableData($count, $offset) {
        return $this->transform($this->getAll("id", true, $count, $offset));
    }

    public function get($id) {
        return $this->transform(parent::get($id));
    }

    // protected function transformElement($categories) {
    //     $categories["link"] = $this->url->categories($categories["id"]);
    //     $categories["link_admin_edit"] = $this->url->adminEditSection($categories["id"]);
    //     $categories["link_admin_delete"] = $this->url->adminDeleteSection($categories["id"]);
    //     return $categories;
    // }


    
    protected function checkData($data) {
        if (!$this->check->title($data["title"])) return "ERROR_TITLE";
        return true;
    }



}



