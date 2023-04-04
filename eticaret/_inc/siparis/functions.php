<?php

function siparisVarmi($sepetCode,$uyeID){
    $query = "SELECT * FROM siparis WHERE  SiparisCode = '$sepetCode' AND  UyeID = '$uyeID'";
    $result = mysql_query($query);
    $num_row = mysql_num_rows($result);
    
    return $num_row;
}

function siparisOlustur($kargoAdresID,$sepetCode,$uyeID,$toplamUrun,$toplamFiyat,$odeme){
    
    
    $siparisVarmi = siparisVarmi($sepetCode,$uyeID);
    
    
    if($siparisVarmi==0){
        //sipariş veritabanına girilecek
    $query = "INSERT INTO siparis  (SiparisCode,UyeID,ToplamUrun,ToplamFiyat,Odeme) VALUES('$sepetCode','$uyeID','$toplamUrun','$toplamFiyat','$odeme')";
    
    $siparisDurum = mysql_query($query);
    $siparisID = mysql_insert_id();
    
    siparisUrunleriVeritabaninaGir($_SESSION['sepet'],$siparisID);
    

    return $siparisID;
    
    
    }else{
        
        return 0;
        
    }
    
    
} //siparisOlustur fns sonu

  //sipariş verilen ürünleri veritabanına girer
function siparisUrunleriVeritabaninaGir($sepet,$siparisID){
//siparişteki ürünler veritabanına girilecek
    
    foreach ($sepet as $urunID => $urunMiktar) {
                
        $query = "INSERT INTO siparis_urun (SiparisID,UrunID,UrunMiktar) VALUES('$siparisID','$urunID','$urunMiktar')";
        mysql_query($query);
        
    }

}//siparisUrunleriVeritabaninaGir fns sonu

//üyenin verdiği siparişlerin sayısını bulur
function uyeSiparisSayisi($uyeID){
    
    $query="SELECT * FROM siparis WHERE UyeID='$uyeID'";
    $result = mysql_query($query);
    $num= mysql_num_rows($result);
    
    return $num;
    
}//uyeSiparisSayisi fns sonu

//sipariş verenin idsini bulur
function sipariseGoreUyeIDBul($siparisID){
    
     $query = "SELECT UyeID FROM siparis WHERE SiparisID = '$siparisID'";
     $result = mysql_query($query);
     
     $row= mysql_fetch_object($result);
     
     return $row->UyeID;
 
} //sipariseGoreUyeIDBul fns sonu
                      
  
?>
