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
$modulID = 6;
$alan = 'Ekle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}
if(modulAktifmi('uye')==0){
    header("Location:../index.php?Hata=PasifModul");
}


//seviye kayıt setinin yapılması
$query_rsUyeSeviye = "SELECT * FROM uye_seviye";
$rsUyeSeviye = mysql_query($query_rsUyeSeviye);
$row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

//form gönderildiğinde
if(isset($_POST['uyeEkleSubmit'])){
    
    $kullaniciAdi = postValues($_POST['KullaniciAdi']);
    $eposta = postValues($_POST['Eposta']);
    
    $query_UyeKontrol = "SELECT * FROM uye WHERE KullaniciAdi='$kullaniciAdi' OR Eposta='$eposta'";
    $rsUyeKontrol = mysql_query($query_UyeKontrol);
    $num_row_rsUyeKontrol = mysql_num_rows($rsUyeKontrol);
    
    if($num_row_rsUyeKontrol>0){
        header("Location:ekle.php?Hata=UyeVar&KullaniciAdi=$kullaniciAdi&Eposta=$eposta");
        exit();
    }
    
    $parola = postValues($_POST['Parola']);
    $parola = md5($parola);
    $seviyeID = postValues($_POST['SeviyeID']);
    $kayitIP = $_SERVER['REMOTE_ADDR'];
    
    if(isset($_POST['Aktif']))
    {
        $aktif = 0;
    }
    
    $query_UyeEkle = "INSERT INTO uye (SeviyeID, KullaniciAdi, Eposta, Parola, Aktif,KayitIP) VALUES("
            . "'$seviyeID', '$kullaniciAdi', '$eposta', '$parola', '$aktif', '$kayitIP')";
    $sonuc = mysql_query($query_UyeEkle);
    
    if($sonuc)
    {
        header("Location:index.php?Islem=UyeEkle");
    }
}



?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Üye Ekle</title>
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
    <h1>Üye Ekle</h1>
    <?php
    if(isset($_GET['Hata']))
    {
        if($_GET['Hata']=='UyeVar')
        {
            echo "<p><strong>Seçmiş üye bulunmaktadır</strong></p>";
        }
    }
    ?>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
        <fieldset>
            <legend>Üye Giriş Bilgileri</legend>
            <label for="KullaniciAdi">Kullanıcı Adı</label>
            <input type="text" name="KullaniciAdi" id="KullaniciAdi" required/>
            <label for="Eposta">E-Posta</label>
            <input type="email" name="Eposta" id="Eposta" required/>
            <label for="Parola">Parola</label>
            <input type="text" name="Parola" id="Parola"/>                       
        </fieldset>
        <fieldset>
        <legend>Seviye ve Aktiflik</legend>
        <label for="SeviyeID">Seviye</label>
        <select name="SeviyeID" id="SeviyeID">
            <?php do {?>
            <option value="<?= $row_rsUyeSeviye->SeviyeID;?>"<?php if($row_rsUyeSeviye->SeviyeID==5)echo"selected";?>><?= $row_rsUyeSeviye->Seviye;?></option>
            <?php }while($row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye));?>
        </select>
        <label for="Aktif">Aktif</label>
        <input type="checkbox" name="Aktif" id="Aktif" checked/>
        </fieldset>
        <input type="submit" name="uyeEkleSubmit" value="Üye Ekle"/>
</form>
</body>
</html>
