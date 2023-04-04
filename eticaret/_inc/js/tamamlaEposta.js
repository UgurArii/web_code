$(document).ready(function(){
    
//kullanıcı tamamla inputunda her yazdığımızda çalışacak
$('.epostaTamamla').keyup(


    function(){
    
      var eposta = $(this).val();
       $('.varolanEposta').html('');

    
    $.post('eposta-ara.php',{eposta:eposta},function(data){
        
        
     $('.sonucEposta').html(data);   
     //üye ara sayfasında değer gelirse yani kullanıcı bulunursa yapılacaklar
    if(data){
        
      $('input[type="submit"]').attr('disabled','disabled');
      $('input[type="submit"]').attr('value','Farklı bir eposta adı giriniz');
      $('input[type="submit"]').addClass('submitDisabled');
      
      
        
    }else{      //üye ara sayfasında değer gelmez ise yani kullanıcı bulunamaz ise yapılacaklar

        
        $('input[type="submit"]').removeAttr('disabled','disabled');
        $('input[type="submit"]').attr('value','Üye Ol');
        $('input[type="submit"]').removeClass('submitDisabled');
        
    }
    

    
        
    });



    
}



);   
    
    
}
);//ready sonu

