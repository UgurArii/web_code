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
$modulID = 12;
$alan = 'Sil';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//cari tip değerinin alınması
$tipID = getValues($_GET['TipID']);

$query_CariTipSil = "DELETE FROM cari_tip WHERE TipID='$tipID'";
$result_CariTipSil = mysql_query($query_CariTipSil);

if($result_CariTipSil)
{
    header("Location:index.php?Islem=CariSil");
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
