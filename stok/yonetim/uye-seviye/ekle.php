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
$alan = 'Ekle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('uye-seviye')==0){
    header("Location:../index.php?Hata=PasifModul");
}

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);
if(isset($_POST['uyeSeviyeEkleSubmit']))
{
//    echo "Form Gönderildi";
//    exit();
    
    $seviye = postValues($_POST['Seviye']);
    $query_UyeSeviyeEkle = "INSERT INTO uye_seviye(Seviye) VALUES('$seviye')";
    $sonuc = mysql_query($query_UyeSeviyeEkle);
    
    if($sonuc){
        header("Location:index.php?Islem=SeviyeEkle");
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Üye Seviye Ekle</title>
    <link href="../../includes/css/form.css" rel="stylesheet" type="text/css"/>
    <link href="../../includes/css/yonetim.css" rel="stylesheet" type="text/css"/>

   </head>
<body>
    <div id="yonetimToolbar">
    <ul>
        <li><a href="../index.php">Anasayfa</a></li> 
        <?php do {?>
        <li><a href="../<?= $row_rsModul->ModulDizin;?>"><img src="../../uploads/modul/<?= $row_rsModul->ModulResim;?>" width="24"/><?= $row_rsModul->ModulAdi;?></a></li> 
        <?php }while ($row_rsModul=  mysql_fetch_object ($rsModul));?>
        <li><a href="../../cikis.php">Çıkış</a></li> 
    </ul>
</div>
    <?php
    // put your code here
    ?>
    <h1>Üye Seviye Ekle</h1>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
        <fieldset>
            <legend>Seviye Bilgileri</legend>
            <label for="Seviye">Seviye</label>
            <input type="text" name="Seviye" id="Seviye" />
            <input type="submit" name="uyeSeviyeEkleSubmit" value="Seviye Ekle"/>
        </fieldset>
    </form>
</body>
</html>
