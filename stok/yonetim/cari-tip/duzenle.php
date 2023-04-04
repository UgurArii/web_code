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
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//tip id değerinin alınması
$tipID = getValues($_GET['TipID']);

$query_rsCariTip = "SELECT * FROM cari_tip WHERE TipID='$tipID'";
$rsCariTip = mysql_query($query_rsCariTip);
$row_rsCariTip = mysql_fetch_object($rsCariTip);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

if(isset($_POST['cariDuzenleSubmit']))
{
  //form değişkenlerinin alınması
    $tip = postValues($_POST['Tip']);
    
    $query_CariTipDuzenle = "UPDATE cari_tip SET Tip='$tip' WHERE TipID='$tipID'";
    $result = mysql_query($query_CariTipDuzenle);
    
    if($result){
        header("Location:index.php?Islem=CariTipDuzenle");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Cari Tip Düzenle</title>
     <style>
        label{
            display: block;
            color: #769dc5;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
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
    <h1>Cari Tip Düzenle</h1>
    <?php
    // put your code here
    ?>
    <form action="<?= phpSelf();?>?TipID=<?= $tipID;?>" method="post">
        <fieldset>
            <legend>Cari Tip Düzenle</legend>
            <label for="Tip">Cari Tip</label> 
            <input type="text" name="Tip" id="Tip" value="<?= $row_rsCariTip->Tip;?>"/>
            <br>
            <input type="submit" name="cariDuzenleSubmit" value="Değişikleri Kaydet"/>
        </fieldset>
    </form>
</body>
</html>
