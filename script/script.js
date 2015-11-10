/**
 * Created by Tatiana on 20.02.2015.
 */
$(document).ready(function(){

    $('.search input[type=search]').focus(function(){
       $(this).attr('value','');
    });
    $('.search input[type=search]').blur(function(){
        $(this).attr('value','Поиск');
    });

    $('.noteHide').click(function(e){
        e.preventDefault();

        $('.orderForms textarea').slideToggle(function(){
            $('.noteHide').toggle();
        });
    });





    if( $('.orderForms input').attr('value') == "" ){

    $('.orderForms input[name=name]').attr('value','Фамилия Имя');
    $('.orderForms input[name=phone]').attr('value','Телефон');
    $('.orderForms input[name=email]').attr('value','Email');
    $('.orderForms input[name=city]').attr('value','город');
    $('.orderForms input[name=street]').attr('value','адрес');

    }
    $('.orderForms  input[type=text]').focus(function(){
        $(this).attr('value','');
    });




    $('.deliveryChoice').change(function(){
        var myChoice = $('.deliveryChoice :selected').val();
        if( myChoice === "0" ) {
            $('.address').fadeIn();
        }else if( myChoice === "1" ){
            $('.address').fadeOut();
        }else{
            return false;
        }
    });

    //$('.selectDelivery').change(function(){
    //    var myChoice = $('.selectDelivery :radio:checked').val();
    //    if(myChoice == 'office'){
    //        $('.address').hide();
    //        $('.office').slideToggle();
    //
    //    }else if(myChoice == 'address'){
    //        $('.office').hide();
    //        $('.address').slideToggle();
    //    }
    //
    //});


});