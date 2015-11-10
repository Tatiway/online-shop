<!--Форма заказа-->
<div class="row">
    <h1 class="title">Форма заказа</h1>
    <?php include "message.tpl";?>
</div>
<div class="row">
    <div class="orderForms span5">
        <form name="order" action="<?=$this->action?>" method="post">

            <input type="text" value="<?=$this->name?>" name="name"><br>
            <input type="text" value="<?=$this->phone?>" name="phone"><br>
            <input type="text" value="<?=$this->email?>" name="email"><br>
            <select name="delivery"class="deliveryChoice">
                <option  selected>-- Выберите способ доставки --</option>
                <option value="0" <?php if($this->delivery == "0") { ?> selected="selected"<?php } ?> >На отделение Новой почты </option>
                <option value="1" <?php if($this->delivery == "1") { ?> selected="selected"<?php } ?> >Самовывоз</option>
            </select><br>
            <div class="address">
                <input type="text" value="<?=$this->city?>" name="city"><br>
                <input type="text" value="<?=$this->street?>" name="street"><br>
            </div>
            <a class="noteHide" href="#"> Примечание к заказу</a>
            <a class="noteHide" style="display: none" href="#"> Скрыть примечание </a>
            <textarea value="<?=$this->notice?>" name="notice"> </textarea><br>
            <input type="hidden" name="func" value="order">
            <input type="image" src="images/confirm.png" class="confirm" alt="Заказ подтверждаю">


        </form>
    </div>