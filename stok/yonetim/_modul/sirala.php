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

if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],2)){
    header("Location:../index.php?Hata=YetkisizGiris");
}

//modül kayıt setinin oluşturulması
$query_rsModul = "SELECT * FROM modul ORDER BY ModulSira, ModulEklemeTarih DESC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

//modül id değeri alınır
$modulID = getValues($_GET['ModulID']);
$islem = getValues($_GET['Islem']);
$modulSira = getValues($_GET['Sira']);
$dateTime = date("Y-m-d H:i:s",  time());

//listede düzeltmek için sonuncuyu artırma
if($islem == 'Artir' && ($num_row_rsModul<=$modulSira)){
    //Artırma işlemi yapılacak
    
    $query_artir = "UPDATE modul SET ModulEklemeTarih = '$dateTime' WHERE ModulID='$modulID'";
    $sonuc = mysql_query($query_artir);
}elseif($islem == 'Azalt' && ($num_row_rsModul<=$modulSira)){
     $query_artir = "UPDATE modul SET ModulSira = ModulSira+1 ModulID='$modulID'";
    $sonuc = mysql_query($query_artir);
     if($sonuc)
    {
        header("Location:index.php");
    }
}


if($islem == 'Azalt' && (1!=$modulSira))
{
      //Azalt işlemi yapılacak
    $query_azalt = "UPDATE modul SET ModulSira = ModulSira-1 WHERE ModulID='$modulID'";
    $sonuc = mysql_query($query_azalt);
    if($sonuc)
    {
        header("Location:index.php");
    }
     
}
header("Location:index.php");
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
