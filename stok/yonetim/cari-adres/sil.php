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
$modulID = 15;
$alan = 'Sil';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(!isset($_GET['AdresID']))
{
    header("Location:index.php?Islem=ParametreYok");
    exit();
}
//Adres ID değerinin alınması
$adresID = getValues($_GET['AdresID']);

//query oluşturmak
$query_CariAdresSil = "DELETE FROM cari_adres WHERE AdresID='$adresID'";
$result = mysql_query($query_CariAdresSil);

if($result)
{
    header("Location:index.php?Islem=CariAdresSil");
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
