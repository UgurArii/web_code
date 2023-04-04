<?php

function yetkiVarmi($uyeID){
    
    $query = "SELECT SeviyeID FROM uye_giris WHERE UyeID = '$uyeID'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    
    return $row->SeviyeID;
}

function uyeKullaniciBul($uyeID){
    $query = "SELECT KullaniciAdi FROM uye_giris WHERE UyeID='$uyeID'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    
    return $row->KullaniciAdi;
}
?>
