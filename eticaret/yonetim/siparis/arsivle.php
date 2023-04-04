<?php 
require_once '../../_inc/connection.php';

require_once '../_inc/uyelik/functions.php';
$yetki = yetkiVarmi($_SESSION['UyeID']);

if($yetki>1){
    header("Location:../../uye-giris.php?Hata=YetkisizKullanici");
    exit();
}

//gelen sipariş id sini alıp arşivleyecek
$siparisID = mysql_real_escape_string($_GET['SiparisID']);

//işlem değeri alınır
$islem = $_GET['Islem'];
if($islem=="Arsivle"){
//query oluştur
$query = "UPDATE siparis SET Arsiv = 1 WHERE SiparisID = '$siparisID'";
mysql_query($query);

header("Location:index.php?Islem=Arsivlendi");
}elseif ($islem=="ArsivdenCikar") {
    //query oluştur
$query = "UPDATE siparis SET Arsiv = 0 WHERE SiparisID = '$siparisID'";
mysql_query($query);

header("Location:index.php?Islem=ArsivdenCikarildi");
}
?>
