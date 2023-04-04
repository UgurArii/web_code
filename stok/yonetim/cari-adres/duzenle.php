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
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}
//cari adres id alınması
$adresID = getValues($_GET['AdresID']);

// cari kayıt
$query_rsCariAdres = "SELECT * FROM cari_adres WHERE AdresID='$adresID'";
$rsCariAdres = mysql_query($query_rsCariAdres);
$row_rsCariAdres = mysql_fetch_object($rsCariAdres);

//cari adres tipikayıt setinin alınması
$query_rsCariAdresTip = "SELECT * FROM cari_adres_tip ORDER VY AdresTip ASC";
$rsCariAdresTip = mysql_query($query_rsCariAdresTip);
$row_rsCariAdresTip = mysql_fetch_object($rsCariAdresTip);

$query_rsCari = "SELECT CariID, CariAdi FROM cari ORDER BY CariAdi ASC";
$rsCari = mysql_query($query_rsCari);
$row_rsCari = mysql_fetch_object($rsCari);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);
if(isset($_POST['cariAdresDuzenle']))
{
    $adresTipID = postValues($_POST['AdresTipID']);
    $cariID = postValues($_POST['CariID']);
    $ulke = postValues($_POST['Ulke']);
    $sehir = postValues($_POST['Sehir']);
    $ilce = postValues($_POST['Ilce']);
    $adres = postValues($_POST['Adres']);
    $telefon = postValues($_POST['Telefon']);
    $fax = postValues($_POST['Fax']);
    
    
    //query oluşturulması
    $query_CariAdresDuzenle = "UPDATE cari_adres SET
        AdresTipID='$adresTipID',
        CariID='$cariID',
        Ulke='$ulke',
        Sehir='$sehir',
        Ilce='$ilce',
        Adres='$adres',
        Telefon='$telefon',
        Fax='$fax'
        WHERE AdresID='$adresID'";
    
      $result = mysql_query($query_CariAdresDuzenle);
    if($result){
        header("Location:index.php?Islem=CariDuzenle");
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
    <form action="<?= phpSelf();?>" method="post">
        <fieldset>
            <legend>Adres Tip ve Cari Bilgileri</legend>
            <label for="AdresTipID">Adres Tipi</label>
            <select name="AdresTipID" id="AdresTipID">
                <?php do {?>
                <option value="<?= $row_rsCariAdresTip->AdresTipID;?>" <?= $selected=($row_rsCariAdresTip->AdresTipID==$row_rsCariAdres->AdresTipID)?' selected':'';?>><?= $row_rsCariAdresTip->AdresTip;?></option>
                <?php }while($row_rsCariTip=  mysql_fetch_object($rsCariAdresTip));?>
            </select>
            <label for="CariID">Cari Adı</label>
            <select name="CariID" id="CariID">
                <?php do{?>
                <option value="<?= $row_rsCari->CariID;?>" <?= $selected=($row_rsCari->CariID==$row_rsCariAdres->CariID)?' selected':'';?>><?= $row_rsCari->CariAdi;?></option>
                <?php }while($row_rsCariAdres=  mysql_fetch_object($rsCariAdres));?>
            </select>
            
        </fieldset>
        <fieldset>
            <legend>Ülke ve Şehir Bilgiler</legend>
            <label for="Ulke">Ülke</label>
            <input type="text" name="Ulke" id="Ulke" value="<?=$row_rsCariAdres->Ulke;?>"/>
        
            <label for="Sehir">Ülke</label>
            <input type="text" name="Sehir" id="Sehir" value="<?=$row_rsCariAdres->Sehir;?>"/>
            
            <label for="Ilce">İlçe</label>
            <input type="text" name="Ilce" id="Ilce" value="<?=$row_rsCariAdres->Ilce;?>"/>
        </fieldset>
        <fieldset>
            <legend>Adres ve Telefon Bilgileri</legend>
        <label for="Adres">Adres</label>
        <textarea type="text" name="Adres" id="Adres" value="<?=$row_rsCariAdres->Adres;?>"></textarea>
        
        <label for="Telefon">Telefon</label>
        <input type="text" name="Telefon" id="Telefon" value="<?=$row_rsCariAdres->Telefon;?>"/>
        
        </fieldset>
    </form>
    
</body>
</html>
