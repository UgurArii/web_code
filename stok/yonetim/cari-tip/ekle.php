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
$alan = 'Ekle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);
if(isset($_POST['cariTipEkleSubmit']))
{
    $cariTip = postValues($_POST['Tip']);
    $query_CariTipEkle = "INSERT INTO cari_tip(Tip) VALUES('$cariTip')";
    $result = mysql_query($query_CariTipEkle);
    
    if($result)
    {
        header("Location:index.php?Islem=CariTipEkle");
    }else{
        
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Cari Tip Ekle</title>
        <link href="../../includes/css/yonetim.css" rel="stylesheet" type="text/css"/>

</head>
<body>
    <?php
    // put your code here
    ?>
    <h1>Cari Tip Ekle</h1>
    <form action="<?= phpSelf();?>" method="post">
        <fieldset>
            <legend>Cari Tipi</legend>
        <label for="Tip">Cari Tip</label> 
        <input type="text" name="Tip" id="Tip" required/>
        <input type="submit" name="cariTipEkleSubmit" value="Cari Ekle"/>
        </fieldset>
    </form>
</body>
</html>
