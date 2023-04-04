$(document).ready(function(){
    
//kullanıcı tamamla inputunda her yazdığımızda çalışacak
$('.kullaniciTamamla').keyup(


    function(){
    
      var kullaniciAdi = $(this).val();
       $('.varolankullanici').html('');

    
    $.post('uye-ara.php',{kullaniciAdi:kullaniciAdi},function(data){
        
        
     $('.sonuc').html(data);   
     //üye ara sayfasında değer gelirse yani kullanıcı bulunursa yapılacaklar
    if(data){
        
      $('input[type="submit"]').attr('disabled','disabled');
      $('input[type="submit"]').attr('value','Farklı bir kullanıcı Adı Seçiniz');
      $('input[type="submit"]').addClass('submitDisabled');
      
      
        
    }else{      //üye ara sayfasında değer gelmez ise yani kullanıcı bulunamaz ise yapılacaklar

        
        $('input[type="submit"]').removeAttr('disabled','disabled');
         $('input[type="submit"]').attr('value','Üye Ol');
      $('input[type="submit"]').removeClass('submitDisabled');
        
    }
    
    
    $('.sonuc li').click(
    
    function(){
        
        var sonuc_degeri = $(this).text();
        $('.varolankullanici').html(sonuc_degeri + " kullanıcısı seçilemez");
        $('.sonuc').html('');
        
    }

        );
    
        
    });



    
}



);   
    
    
}
);//ready sonu

