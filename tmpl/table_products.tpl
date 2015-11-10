<div class="row">

    <?php

    for($i = 0; $i < count($this->products); $i++){ ?>

        <div class="block span1">
            <a href="<?=$this->products[$i]['link']; ?>"><img class="photo" src="<?=$this->products[$i]['img']; ?>"</a>
            <div class="nameTarget"><a href="<?=$this->products[$i]['link']; ?>"><?=$this->products[$i]['title']; ?></a></div>
            <p class="price"><?=$this->products[$i]['price']; ?><span class="littleFont"> грн</span></p>
            <p class="action">Акция</p>
            <a href="<?=$this->products[$i]['link_cart']?>"> в корзину</a>
        </div>

    <?php } ?>

</div>

