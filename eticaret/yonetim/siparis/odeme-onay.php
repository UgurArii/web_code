<?php 
require_once '../../_inc/connection.php';

require_once '../_inc/uyelik/functions.php';
$yetki = yetkiVarmi($_SESSION['UyeID']);

if($yetki>1){
    header("Location:../../uye-giris.php?Hata=YetkisizKullanici");
    exit();
}
$islem = $_GET['Islem'];
$siparisID = mysql_real_escape_string($_GET['SiparisID']);

//ödeme onayı ise
if($islem=="OdemeOnayla"){
    $query = "UPDATE siparis SET Odeme=1 WHERE SiparisID='$siparisID'";
    mysql_query($query);
    header("Location:index.php?Islem=OdemeOnayla");
}

//onay iptal ise
elseif($islem=="OdemeOnayIptal"){
    $query = "UPDATE siparis SET Odeme=0 WHERE SiparisID='$siparisID'";
    mysql_query($query);
    header("Location:index.php?Islem=OdemeOnayIptal");
}
?>
