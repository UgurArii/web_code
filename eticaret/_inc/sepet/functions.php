<?php

//function br(){ echo "<br/>";}
//function post(){    print_r($_POST);}
//function get(){ print_r($_GET);}
//function files(){    print_r($_FILES);}
//function sessions(){    print_r($_SESSION);}
function  sepetVarmi(){
    if(isset($_SESSION['sepet'])){
        return TRUE;
    }else{
      
        return FALSE;
    }
}

function sepetOlustur(){
    $_SESSION['sepet'] = array();
    $_SESSION['toplam_urun']=0;
    $_SESSION['toplam_fiyat']=0.00;
    $_SESSION['sepetcode'] = rand(1,1000000) ."-" .md5(rand(1,1000000));

    return TRUE;
}

function    sepetYokEt(){
    unset($_SESSION['sepet']);
}
function sepeteEkle($urunID){
    
    if(!isset($_SESSION['sepet'][$urunID])){
        $_SESSION['sepet'][$urunID]=1;
    }else{
          $_SESSION['sepet'][$urunID]++;
    }
}

function sepetToplamUrun(){
    $sepetToplam = 0;
    foreach ($_SESSION['sepet'] as $urunID => $miktar){
        $sepetToplam += $miktar;
        
    }
    return $sepetToplam;
}

function urunFiyatHesapla($urunFiyat, $kdvID){
    $query = "SELECT * FROM urun_kdv WHERE KdvID='$kdvID'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    $kdv = $row->Kdv;
    $urunFiyat = $urunFiyat + ($urunFiyat * $kdv/100);
    
    return $urunFiyat;
    
    
}

function  sepetTopluGuncelle(){
      //sepet gezilecek
    foreach ($_SESSION['sepet'] as $urunID=>$miktar){
        //ıd değeri 0 olan ürün silinecek
        if($_POST[$urunID]==0){
            unset($_SESSION['sepet'][$urunID]);
        }else{
             $_SESSION['sepet'][$urunID] = $_POST[$urunID];
        }
        
    }
}

   function toplamFiyatHesapla($sepet){
                     $toplamFiyat = 0;
                     foreach ($sepet as $urunID=>$urunMiktar){
                        $query = "SELECT UrunFiyat FROM urun WHERE UrunID='$urunID'";
                        $result = mysql_query($query);
                        $row = mysql_fetch_object($result);
                        $urunToplamFiyat = $row->UrunFiyat * $urunMiktar; 
                         $toplamFiyat += $urunToplamFiyat; 
                        
                     }
                     return $toplamFiyat;
                        }
                        
                        

                        
?>
