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

if(GirisVarmi()){
    header("Location:../index.php?Hata=GirisYap");
}

//modul aktifleştir
$modulID = getValues($_GET['ModulID']);

$aktiflik = getValues($_GET['Aktif']);
$aktif = $aktiflik?0:1;

$query_ModulAktiflestir = "UPDATE modul SET ModulAktif='$aktif' WHERE ModulID='$modulID'";
$sonuc = mysql_query($query_ModulAktiflestir);

if($sonuc){
    header("Location:index.php?Islem=Aktiflestirme");
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
