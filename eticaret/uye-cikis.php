<?php
session_start();


if(!isset($_SESSION['UyeID'])){
    //üye giriş yapılmadığında
    header("Location:uye-giris.php?Hata=GirisYap");
    
}else{
    //giriş yapıldığından ve çıkış yapılmak istendiğinde
    unset($_SESSION['UyeID']);
    unset($_SESSION['KullaniciAdi']);
    unset($_SESSION['Eposta']);
    unset($_SESSION['SeviyeID']);
    header("Location:uye-giris.php?Bilgi=CikisYapildi");
}

?>
