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
$modulID = 14;
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//cari adres tip değerinin alınması
$cariAdresTipID = postValues($_GET['AdresTipID']);

//cari adres tip kayıt setinin alınması
$query_rsCariAdresTip = "SELECT * FROM cari_adres_tip WHERE AdresTipID='$cariAdresTipID'";
$rsCariAdresTip = mysql_query($query_rsCariAdresTip);
$row_rsCariAdresTip = mysql_fetch_object($rsCariAdresTip);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

if(isset($_POST['cariAdresTipEkle'])){
    
    //formdan gelen verilerin alınması
    $adresTip = postValues($_POST['AdresTip']);
    
    //query oluşturuılması
    $query_cariAdresTipDuzenle = "UPDATE cari_adres_tip SET AdresTip ='$adresTip' WHERE AdresTipID='$adresTipID'";
    $result = mysql_query($query_cariAdresTipDuzenle);
    
    if($result){
        header("Location:index.php?Islem=CariAdresTipDuzenle");
    }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Cari Adres Tip Düzenle</title>
     
    <style>
        label{
            display: block;
            color:#769dc5;
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
    <h1>Cari Adres Tip Düzenle</h1>
    <?php
    // put your code here
    ?>
    <form action="<?= phpSelf();?>" method="post">
        <fieldset>
            <legend>Cari Adres Tipi</legend>
            <label for="AdresTip">Adres Tipi</label>
            <input type="text" name="AdresTip" id="AdresTip" value="<?=$row_rsCariAdresTip->AdresTip;?>"/>
            <br>
            <input type="submit" name="cariAdresTipEkle" value="Cari Adres Tip Düzenle"/> 
        </fieldset>
    </form>
</body>
</html>
