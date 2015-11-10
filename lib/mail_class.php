<?php
/**
 * Created by PhpStorm.
 * User: Tatiana
 * Date: 26.02.2015
 * Time: 23:49
 */

//класс для отправки сообщений на почту пользователя
require_once 'config_class.php';
require_once 'email_class.php';

class Mail {

    private $config;
    private $email;


    public function __construct(){
        $this->config = new Config();
        $this->email = new Email();

    }

    public function send($to, $data, $template, $from = ""){

        $data["sitename"]=$this->config->sitemane;
        if($from == "" )$from = $this->config->abminmail;

        $subject = $this->email->getTitle($template);
        $message = $this->email->getText($template);
        $headers = "From: $from\r\nReply-To: $from\r\nContent-type: text/html; charset=utf-8\r\n";
         foreach($data as $key => $value){
             $subject = str_replace("%$key%", $value, $subject);
             $message = str_replace("%$key%", $value, $message);
         }
        //кодирует тему сообщения в формат utf-8
        $subject = '=?utf-8?B?'.base64_encode($subject).'?=';

        return mail($to, $subject ,$message, $headers);


    }



}