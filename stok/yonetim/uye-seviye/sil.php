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
$modulID = 7;
$alan = 'Sil';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('uye-seviye')==0){
    header("Location:../index.php?Hata=PasifModul");
}

$uyeID = getValues($_GET['UyeID']);
if($uyeID==1)
{
    header("Location:index.php?Hata=AnaHesap");
    exit();
 }
 
 $query_UyeSil = "DELETE FROM uye WHERE UyeID='$uyeID'";
 $sonuc = mysql_query($query_UyeSil);
 
 if($sonuc)
 {
     header("Location:index.php?Islem=UyeSil");
 }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
    // put your code here
    ?>
</body>
</html>
