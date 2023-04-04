<?php
//session başlatılması
session_start();

//sunucu bağlantısı ve veritabanı seçimi
require_once '../../includes/connection.php';

//form fonktisonları
require_once '../../includes/functions.php';

if(!GirisVarmi()){
    header("Location:../index.php?Hata=GirisYap");
}


$uyeID = $_SESSION['Uye']['UyeID'];
$modulID = 6;
$alan = 'Sil';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('urun-kategori')==0){
    header("Location:../index.php?Hata=PasifModul");
}
//kategoriID değerinin alınması
$kategoriID = getValues($_GET['KategoriID']);

$urunSayisi = UrunVarmi($kategoriID);

if($urunSayisi==0)
{
    $query = "DELETE FROM kategori WHERE KategoriID='$kategoriID'";
    $result = mysql_query($query);
    if($result)
    {
        header("Location:index.php?Islem=KategoriSil");
    }else{
        exit();
    }
}
?>
