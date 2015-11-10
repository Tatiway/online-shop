<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 26.02.2015
 * Time: 23:41
 */
require_once 'globalmessage_class.php';

class Message extends GlobalMessage {

    public function __construct(){
        parent::__construct("masseges");
    }

}