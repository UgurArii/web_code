<?php
//session başlatılması
session_start();
//sunucu bağlantısı ve veritabanı seçimi
require_once 'includes/connection.php';

//form fonktisonları
require_once 'includes/functions.php';

if(!GirisVarmi()){
    header("Location:../index.php?Hata=GirisYap");
}

if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],2)){
    header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('uye-giris')==0){
    header("Location:../index.php?Hata=PasifModul");
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
