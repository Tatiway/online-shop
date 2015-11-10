<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 26.02.2015
 * Time: 23:36
 */

require_once 'complexmassege_class.php';

class PageMessage extends ComplexMassege {

    public function __construct(){
        parent::__construct("page_masseges");
    }

}