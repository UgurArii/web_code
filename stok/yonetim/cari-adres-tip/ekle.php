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
$alan = 'Ekle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

if(isset($_POST['cariAdresTipEkle']))
{
    //form verilerinin alınması
    $adresTip = postValues($_POST['AdresTip']);
    
    $query_CariAdresTipEkle = "INSERT INTO cari_adres_tip(AdresTip) VALUES('$adresTip')";
    $result = mysql_query($query_CariAdresTipEkle);
    
    if($result){
        header("Location:index.php?Islem=CariAdresTipEkle");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
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
            <input type="text" name="AdresTip" id="AdresTip" required/>
            <br>
            <input type="submit" name="cariAdresTipEkle" value="Cari Adres Tip Ekle"/> 
        </fieldset>
</body>
</html>
