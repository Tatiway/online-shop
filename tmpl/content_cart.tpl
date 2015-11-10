<form name="cart" action="<?=$this->action?>" method="post">
<div class="row">
    <table class="crumbsNav">
        <tr>
            <td><a href="#">Главная</a></td>
            <td><img src="images/arrow.png"></td>

            <td><a href="#">Компьютеры</a></td>
            <td><img src="images/arrow.png"></td>
            <td>Корзина</td>
        </tr>
    </table>
</div>
<!--Корзина заказа-->
<div class="row">
    <h1 class="title">Корзина</h1>
</div>
<div class="row">
    <?php for($i = 0; $i<count($this->cart); $i++ ){ ?>
    <div class="productCart span5">
        <ul>
            <li><img src="<?=$this->cart[$i]['imgSmall']?>"></li>
            <li>
                <div class="titleCart"><?=$this->cart[$i]['title']?></div>
                <p><span class="littleFont">Артикул:</span> <?=$this->cart[$i]['id']?></p>
                <p class="saleCart">Скидка <?=$this->cart[$i]['sale']?>%</p>
                <p class="costCart"><?=$this->cart[$i]['price']?><span class="littleFont"> &nbsp;&nbsp;грн</span> </p>
            </li>
            <li><input type="text" name="count_<?=$this->cart[$i]['id']?>" value="<?=$this->cart[$i]['count']?>">шт</li>
            <li><p class="sum"><?=$this->cart[$i]['summa']?><span class="littleFontCart"> &nbsp;&nbsp;грн</span></p></li>
            <li><a href="<?=$this->cart[$i]['link_delete']?>" class="delete">X</a></li>
        </ul>
    </div>
    <?php } ?>
</div>
<!--кнопка пересчитать-->
<div class="row">
    <div class="finally span5">
        <input type="image"  src="images/recCalc.png" alt="Пересчитать" class="reCalc"  >
    </div>
</div>
<!--кнопка получить скидку-->
<div class="row">
    <div class="bonus finally span5">
        <ul>
            <li><p class="amount"><span class="littleFont">Введите номер купона со скидкой:</span> </p></li>
            <li><input type="text" name="discount" value="<?=$this->discount?>"></li>
            <li><input type="image"  src="images/getDisc.png" alt="Получить скидку"  class="getDisc" >
        </ul>
    </div>
</div>
<!--кнопка оформить заказ-->
<div class="row">
    <div class="finally span5">
        <ul>
            <li><p class="amount"><span class="littleFont">Всего:<?php if($this->discount){ ?> с учетом скидки <?php }?></span>  <?=$this->summa?> грн</p></li>
            <input type="hidden" name="func" value="cart"><!-- отправляет func  с значением cart post запрос для обновления корзины заказа-->
            <!--для офрмления заказа-->
            <li><li><a class="issue" href="<?=$this->link_order?>" ></a></li></li>
        </ul>
    </div>
</div>
</form>



