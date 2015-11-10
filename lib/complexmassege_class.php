<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 26.02.2015
 * Time: 23:16
 */

require_once 'globalmessage_class.php';

abstract class ComplexMassege extends GlobalMessage {

    public function getTitle($name){
        return $this->get($name."_TITLE");
    }

    public function getText($name){
        return $this->get($name."_TEXT");
    }

}