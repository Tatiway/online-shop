<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 27.02.2015
 * Time: 12:30
 */


//шаблонизатор
class Template {

    private $dir_tmpl;// директория к tpl файлу
    private $data = array();// и набор данных который класс отвещающий за главную страницу сюда поместит


    public function __construct($dir_tmpl){
        $this->dir_tmpl = $dir_tmpl;

    }
    //устанавливает значения
    public function set($name, $value){
        $this->data[$name] = $value;
    }

    public function delete($name){
        unset($this->data[$name]);
    }
    // вызывется если мы обращаемся к данному классу к его свойству

    // если мы пишем в tpl файле $this->title, то автоматом вызывется метод __get
    // если $name-такой ключ (title) существунт,то возвращаем значение
    public function __get($name){
        if(isset($this->data[$name])) return $this->data[$name];
        return "";

    }


//занимается выводом шаблона $template-названия шаблона
    public function display($template){
        $template = $this->dir_tmpl.$template.".tpl";
        ob_start();//помущаем в буфер
        include($template);
        echo ob_get_clean();//вывод содержимого данного буфера
    }

}


