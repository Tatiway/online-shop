
<!--Хлебные крошки-->
<div class="row">
    <table class="crumbsNav">
        <tr>
            <td><a href="<?=$this->index?>">Главная</a></td>
            <td><img src="images/arrow.png"></td>

            <td><a href="<?=$this->link_categories?>"><?=$this->product['cat']?></a></td>
            <td><img src="images/arrow.png"></td>
            <td><?=$this->product['title']?></td>
        </tr>
    </table>
</div>
<!--описание одного товара -->
<div class="row">
    <h1 class="title"><?=$this->product['title']?><span class="littleFont"> <?=$this->product['cat']?> &nbsp;</span></h1>
</div>
<div class="row">
    <div class="photoOneTarget span3" >
        <img src="<?=$this->product['imgBig']?>" alt="<?=$this->product['title']?>">
    </div>
    <div class="description span4" >
        <div class="article"><span class="littleFont">Артикул:</span> <?=$this->product['id']?></div>
        <div class="lineDotted"></div><!--пунктирная линия-->
        <div class="buttBlock">
            <ul class="buttonBlock">
                <li><a class="buttonG" href="<?=$this->product['link_cart']?>"></a></li>
                <li><p class="cost"><?=$this->product['price']?><span class="littleFont"> &nbsp;&nbsp;грн</span> </p></li>
                <li><p class="sale">Скидка <?=$this->product['sale']?>% </p></li>
            </ul>
        </div>
        <div class="lineDotted"></div><!--пунктирная линия-->
        <div class="charact">
            <h3>Характеристики</h3>
            <?=$this->product['description']?>
        </div>
        <div class="lineDotted"></div><!--пунктирная линия-->
        <div class="about">
            <?=$this->product['descriptionfull']?>
        </div>
    </div>

</div>
<div class="row">
    <h1 class="title">Вам также может подойти:</h1>
</div>
<div class="row">

        <?php for($i=0; $i<count($this->products); $i++) {      ?>

         <div class="block span1">
             <a href="<?=$this->products[$i]['link']?>"><img class="photo" src="<?=$this->products[$i]['img']?>"></a>
             <div class="nameTarget"><a href="<?=$this->products[$i]['link']?>"><?=$this->products[$i]['title']?></a></div>
             <p class="price"><?=$this->products[$i]['price']?><span class="littleFont"> грн</span></p>
             <p class="action">Акция</p>
         </div>

        <?php } ?>

</div>