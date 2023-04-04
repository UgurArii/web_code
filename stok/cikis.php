<?php
//session başlatılması
session_start();
//sunucu bağlantısı ve veritabanı seçimi
require_once 'includes/connection.php';

//form fonktisonları
require_once 'includes/functions.php';

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
    
    unset($_SESSION['Uye']['KullaniciAdi']);
    unset($_SESSION['Uye']['Eposta']);
    unset($_SESSION['Uye']['UyeID']);
    unset($_SESSION['Uye']['SeviyeID']);
    
    header("Location:index.php?Islem=CikisYapidi");
    ?>
</body>
</html>
