<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 26.02.2015
 * Time: 23:28
 */
require_once 'complexmassege_class.php';


class Email extends ComplexMassege {

    public function __construct(){
        parent::__construct("emails");
    }

}