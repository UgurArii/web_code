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
$modulID = 13;
$alan = 'Ekle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//cari tip kayıt set
$query_rsCariTip = "SELECT * FROM cari_tip ORDER BY Tip ASC";
$rsCariTip = mysql_query($query_rsCariTip);
$row_rsCariTip = mysql_fetch_object($rsCariTip);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

if(isset($_POST['cariEkleSubmit']))
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
    
    //query oluşturması
    $query_cariEkle = "INSERT INTO cari(TipID, CariKodu, CariAdi, Eposta, Telefon, VergiDairesi, VergiNo, Notlar)"
            . " VALUES('$tipID','$cariKodu','$cariAdi','$eposta','$telefon','$vergiDairesi','$vergiNo','$notlar')";

    $result = mysql_query($query_cariEkle);
    
    if($result){
        header("Location:index.php?Islem=CariEkle");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Cari Ekle</title>
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
    <h1>Cari Ekle</h1>
    <?php
    // put your code here
    ?>
    <form action="<?= phpSelf();?>" method="post">
        <fieldset>
        <legend>Cari Bilgiler</legend>
        <label for="TipID">Cari Tipi</label>
        <select name="TipID" id="TipID">
          
            <?php do{?>
            <option value="<?= $row_rsCariTip->TipID;?>"><?= $row_rsCariTip->Tip;?></option>
            <?php }while($row_rsCariTip=  mysql_fetch_object($rsCariTip));?>
        </select>    
         
        <label for="CariKodu">Cari Kodu</label>
        <input type="text" name="CariKodu" id="CariKodu" required/>
        
        <label for="CariAdi">Cari Adı</label>
        <input type="text" name="CariAdi" id="CariAdi" required/>
        
        <label for="Eposta">Eposta</label>
        <input type="email" name="Eposta" id="Eposta" />
        
        <label for="Telefon">Telefon</label>
        <input type="text" name="Telefon" id="Telefon"/>
        </fieldset>
        <fieldset>
            <legend>Cari Vergi Bilgileri</legend>
        <label for="VergiDairesi">Vergi Dairesi</label>
        <input type="text" name="VergiDairesi" id="VergiDairesi"/> 
       
        <label for="VergiNo">Vergi No</label>
        <input type="text" name="VergiNo" id="VergiNo"/> 
       
        <br>
        <input type="submit" name="cariEkleSubmit" value="Cari Ekle"/>
        </fieldset>
        
        <fieldset>
            <legend>Özel Notlar</legend>
        <label for="Notlar">Vergi Dairesi</label>
        <textarea type="text" name="Notlar" id="Notlar" rows="10" cols="50"></textarea>
       
        </fieldset>
    </form>
</body>
</html>
