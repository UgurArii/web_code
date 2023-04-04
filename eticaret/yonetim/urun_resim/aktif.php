<?php 
require_once '../../_inc/connection.php';

require_once '../_inc/uyelik/functions.php';
$yetki = yetkiVarmi($_SESSION['UyeID']);

if($yetki>1){
    header("Location:../../uye-giris.php?Hata=YetkisizKullanici");
    exit();
}
$islem = $_GET['Islem'];
$urunID = mysql_real_escape_string($_GET['UrunID']);
$resimID = mysql_real_escape_string($_GET['ResimID']);


//ödeme onayı ise
if($islem=="Aktiflestir"){
    $query = "UPDATE urun_resim SET Aktif=1 WHERE UrunID='$urunID' AND ResimID='$resimID'";
    mysql_query($query);
    header("Location:index.php?Islem=Aktiflestirildi&UrunID='$urunID'");
}

//onay iptal ise
elseif($islem=="Pasiflestir"){
    $ $query = "UPDATE urun_resim SET Aktif=0 WHERE UrunID='$urunID' AND ResimID='$resimID'";
    mysql_query($query);
    header("Location:index.php?Islem=Pasiflestirildi&UrunID='$urunID'");
}
?>
