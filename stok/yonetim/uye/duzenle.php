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
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('uye')==0){
    header("Location:../index.php?Hata=PasifModul");
}
$uyeID = $_GET['UyeID'];

$query_rsUye = "SELECT * FROM uye WHERE UyeID='$uyeID'";
$rsUye = mysql_query($query_rsUye);
$row_rsUye = mysql_fetch_object($rsUye);

$query_rsUyeSeviye= "SELECT * FROM uye_seviye";
$rsUyeSeviye = mysql_query($query_rsUyeSeviye);
$row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

if(isset($_POST['uyeDuzenleSubmit']))
{
    $seviyeID = postValues($_POST['SeviyeID']);
    $kullaniciAdi = postValues($_POST['KullaniciAdi']);
    $eposta = postValues($_POST['Eposta']);
    $query_UyeKontrol = "SELECT * FROM uye WHERE (KullaniciAdi='$kullaniciAdi' OR Eposta='$eposta') AND UyeID='$uyeID'";
    $rsUyeKontrol = mysql_query($query_UyeKontrol);
    $num_row_rsUyeKontrol = mysql_num_rows($rsUyeKontrol);
    
    if($num_row_rsUyeKontrol>0){
        header("Location:duzenle.php?UyeID=$uyeID&Hata=UyeVar&KullaniciAdi=$kullaniciAdi&Eposta=$eposta");
        exit();
    }
    
    $parola = postValues($_POST['Parola']);
    $parolaTekrar = postValues($_POST['ParolaTekrar']);
    if(isset($_POST['Aktif']))
    {
        $aktif = 1;
    }else{
        $aktif = 0;
    }
    
    if(!empty($parola)){
        if($parola = $parolaTekrar)
        {
            $parola = md5($parola);
        }else{
            header("Location:duzenle.php?UyeID=$uyeID&Hata=ParolaTekrar");
            exit();
        }
    }else{
        $parola = $row_rsUye->Parola;
    }
    $query_Duzenle = "UPDATE uye SET 
        SeviyeID='$seviyeID',
        KullaniciAdi = '$kullaniciAdi',
        Eposta = '$eposta',
        Parola = '$parola',
        Aktif = '$aktif'
        WHERE UyeID='$uyeID'    
";
            
    $sonuc = mysql_query($query_Duzenle);
    if($sonuc){
        header("Location:index.php?Islem=UyeDuzenle");
        
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Üye Düzenle</title>
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
    <h1>Üye Düzenle</h1>
    <?php
    if(isset($_GET['Hata']))
    {
        if($_GET['Hata']=='ParolaTekrar')
        {
            echo "<p><strong>Yeni parola aynı değil</strong></p>";
        }
        if($_GET['Hata']=='UyeVar')
        {
            echo "<p><strong>Seçmiş üye bulunmaktadır</strong></p>";
        }
    }
    ?>
    
    <form action="<?= $_SERVER['PHP_SELF'];?>?UyeID=<?= $uyeID;?>" method="post">
        <fieldset>
            <legend>Seviye ve Aktiflik</legend>
            <label for="SeviyeID">Seviye</label>
            <select name="SeviyeID" id="SeviyeID">
                <?php do{?>
                <option value="<?= $row_rsUyeSeviye->SeviyeID;?>"
                <?php if($row_rsUye->SeviyeID=$row_rsUyeSeviye->SeviyeID){ echo "selected";}?><<?= $row_rsUyeSeviye->Seviye ;?></option>
                <?php }while($row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye));?>
            </select>
            <label for="Aktif">Aktif</label>
            <input type="checkbox" name="Aktif" id="Aktif" <?php if($row_rsUye->Aktif==1){echo "checked";}?>/>
        </fieldset>
         <fieldset>
            <legend>Giriş Bilgileri</legend>
            <label for="KullaniciAdi">Kullanıcı Adı</label>
            <input type="text" name="KullaniciAdi" id="KullaniciAdi" value="<?= $row_rsUye->KullaniciAdi;?>" required/>
            <label for="Eposta">Eposta</label>
            <input type="email" name="Eposta" id="Eposta" value="<?= $row_rsUye->Eposta;?>" required/>
           <label for="Parola">Yeni Parola</label>
            <input type="password" name="Parola" id="Parola"/>
              <label for="ParolaTekrar">Yeni Parola Tekrar</label>
            <input type="password" name="ParolaTekrar" id="ParolaTekrar"/>
           
            <br>
            <input type="submit" id="uyeDuzenleSubmit" value="Değişiklikleri Kaydet"/>
        </fieldset>
    </form>
</body>
</html>
