<?php

class Config {

    public $secret = "GYHGUGUYG";

    public $sitename = "ishoptati.hol.es";
    public $address = "http://ishoptati.hol.es/";
    public $address_admin = "http://ishoptati.hol.es/admin/";
    public $db_host = "localhost";
    public $db_user = "u541636291_root";
    public $db_password = "w0ie0JtCK9";
    public $db_name = "u541636291_cust";
    public $db_prefix = "shop_";
    public $sym_query = "{?}";//уникальный символ для составления запросов к базе данных

    public $admname = "Кушнир Татьяна";
    public $abminmail = "tatiway@mail.ru";
    public $adm_login = "Admin";
    public $adm_password = "d8fd511e475c62d684d83b46e184178f";//пароль - 123

    public $dir_text = "lib/text/";
    public $dir_tmpl = "tmpl/";
    public $dir_tmpl_admin = "admin/tmpl/";

    public $count_on_page = 8;
    public $count_others =4;
    public $dir_img_products = "images/products/";

    public $max_name = 255;
    public $max_title = 255;
    public $max_text = 65535;


}