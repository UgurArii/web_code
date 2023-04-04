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

if(!GirisVarmi()){
    header("Location:../index.php?Hata=GirisYap");
}


$uyeID = $_SESSION['Uye']['UyeID'];
$modulID = 13;
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//CariID değerinin alınması
$cariID = getValues($_GET['CariID']);

//cari kayıt setinin alınması
$query_rsCari = "SELECT * FROM cari WHERE CariID='$cariID'";
$rsCari =  mysql_query($query_rsCari);
$row_rsCari = mysql_fetch_object($rsCari);

$query_rsCariTip = "SELECT * FROM cari_tip ORDER BY Tip ASC";
$rsCariTip =  mysql_query($query_rsCariTip);
$row_rsCariTip = mysql_fetch_object($rsCariTip);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

//form gönderildi
if(isset($_POST['cariDuzenleSubmit']))
{
       //formdan gelen değerler
    $tipID = postValues($_POST['TipID']);
    $cariKodu = postValues($_POST['CariKodu']);
    $cariAdi = postValues($_POST['CariAdi']);
    $eposta = postValues($_POST['Eposta']);
    $telefon = postValues($_POST['Telefon']);
    $vergiDairesi = postValues($_POST['VergiDairesi']);
    $vergiNo = postValues($_POST['VergiNo']);
    $notlar = postValues($_POST['Notlar']);
    
    $query_CariDuzenle = "UPDATE cari SET 
        TipID='$tipID', CariKodu='$cariKodu', CariAdi='$cariAdi',
        Eposta='$eposta', Telefon='$telefon', VergiDairesi='$vergiDairesi',
        VergiNo = '$vergiNo', Notlar='$notlar' WHERE CariID='$cariID';";

    $result = mysql_query($query_CariDuzenle);
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
    
    <form action="<?= phpSelf();?>/CariID=<?= $cariID;?>" method="post">
        <fieldset>
            <legend>Cari Bilgiler</legend>
            <label for="TipID">Cari Tipi</label>
            <?php echo "cari değer ".$row_rsCari->TipID;?>
            <select name="TipID" id="TipID">
                <?php do{?>
                <option value="<?= $row_rsCariTip->TipID;?>" <?php $selected=($row_rsCari->TipID==$row_rsCariTip->TipID)?'selected':'';?>><?= $row_rsCariTip->Tip;?></option>
                <?php }while($row_rsCariTip=  mysql_fetch_object($rsCariTip));?>
            </select>
            
            <label for="CariKodu">Cari Kodu</label>
            <input type="text" name="CariKodu" id="CariKodu" value="<?= $row_rsCari->CariKodu;?>" required/>
            <label for="CariAdi">Cari Adı</label>
            <input type="text" name="CariAdi" id="CariAdi" value="<?= $row_rsCari->CariAdi;?>" required/>
            <label for="Eposta">Eposta</label>
            <input type="text" name="Eposta" id="Eposta" value="<?= $row_rsCari->Eposta;?>"/>
            <label for="Telefon">Telefon</label>
            <input type="text" name="Telefon" id="Telefon" value="<?= $row_rsCari->Telefon;?>"/>
        
        </fieldset>
        <fieldset>
            <legend>Vergi Bilgileri</legend>
            <label for="VergiDairesi">Vergi Dairesi</label>
            <input type="text" name="VergiDairesi" id="VergiDairesi" value="<?= $row_rsCari->VergiDairesi;?>"/>
            <label for="VergiNo">Vergi No</label>
            <input type="text" name="VergiNo" id="VergiNo" value="<?= $row_rsCari->VergiNo;?>"/>
            
            <input type="submit" name="cariDuzenleSubmit" value="Değişiklikleri Kaydet"/>
        </fieldset>
        <fieldset>
            <legend>Notlar</legend>
            <label for="Notlar">Notlar</label>
            <textarea name="Notlar" id="Notlar" rows="10" cols="50">
                <?= $row_rsCari->Notlar;?>
            </textarea>
        </fieldset>
    </form>
</body>
</html>
