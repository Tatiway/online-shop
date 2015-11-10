<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="description" content="<?=$this->meta_desc ?>">
    <meta name="keywords" content="<?=$this->meta_key?>">
    <link href="css/style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <script src="script/jquery.js"></script>
    <script src="script/script.js"></script>
    <title><?=$this->title ?></title>
</head>
<body>
<div id="container">

    <!--Начало headera-->

    <!--Начало headerOne-->
    <div id="headerOne">
        <div id="iHeaderOne">
            <ul id="nav">
                <li><a href="#">Как купить</a></li>
                <li><a href="<?=$this->link_delivery?>">Доставка оплата</a></li>
                <li><a href="#">Гарантия</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="<?=$this->link_contacts?>">Контакты</a></li>
            </ul>
            <p class="telPhoto"></p>
            <p class="tel">+38 (093) 189 40 20</p>
        </div>
    </div>
    <!--Начало headerTwo-->
    <div id="headerTwo">
        <div id="iHeaderTwo">
            <a href="<?=$this->index?>"><div class="logo"></div></a>
            <div class="search">
                <form name="search" action="<?=$this->link_search?>" method="get">
                    <input type="search" name="q" value="Поиск">
                    <input type="submit" value="">
                </form>
            </div>
            <a href="<?=$this->link_cart?>"><div class="cart"> </div></a>
            <div class="target"><span class="greenBold"><?=$this->cart_count?></span><a href="<?=$this->link_cart?>"> ТОВАРОВ</a><span class="greenBold">&nbsp;  / </span> <span class="whiteLittle"><?=$this->cart_summa?> грн</span> </div>
        </div>
    </div>
    <!--Начало headerThree-->
    <div id="headerThree">
        <div id="iHeaderTree">
            <div id="topMenu">
                <ul>
                    <?php

                    for ($i = 0; $i < count($this->items); $i++){ ?>

                    <li><a href="<?=$this->items[$i]['link'] ?>"><?=$this->items[$i]['title'] ?></a></li>
                    <li><img src="images/separator.png"></li>

                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>

    <!--Начало Контента-->
    <div id="content">
        <div id="iContent">
            <?php include "content_".$this->content.".tpl"; ?>
        </div>
    </div>

    <!--Начало Футер-->
    <div id="footer">
        <div class="line"></div>
        <div id="iFooter">
            <div class="row">
                <div class="contacts span1">
                    <h2>Наши контакты</h2>
                    <p class="marg"></p>
                    <p><span class="littleFont"> тел &nbsp;</span>(048)360 33 46</p>
                    <p><span class="littleFont"> тел &nbsp;</span>(093)189 40 20</p>
                    <p class="marg"></p>
                    <p>г.Одессa</p>
                    <p>ул. Сегедская , 9 ,1 этаж</p>
                </div>
                <div class="schedule span1">
                    <h2>График работы</h2>
                    <p class="marg"></p>
                    <h3>Пн - Пт :</h3><p>10.00 - 19.00</p>
                    <p class="marg"></p>
                    <h3>Cб - Вс :</h3><p>10.00 - 16.00</p>
                </div>
                <div class="representation span1">
                    <h2>Представительства</h2>
                    <p class="marg"></p>
                    <a href="#"><p class="vk"></p></a>
                    <a href="#"><p class="facebook"></p></a>
                </div>
            </div>


        </div>
    </div>
</div>

</body>
</html>