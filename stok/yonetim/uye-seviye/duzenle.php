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
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);
if(modulAktifmi('uye-seviye')==0){
    header("Location:../index.php?Hata=PasifModul");
}
//seviyeID değerinin alınması
$seviyeID = getValues($_GET['SeviyeID']);

//query oluşturması
$query_rsUyeSeviye = "SELECT * FROM uye_seviye WHERE SeviyeID='$seviyeID'";
$rsUyeSeviye = mysql_query($query_rsUyeSeviye);
$row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye);

if(isset($_POST['uyeSeviyeDuzenleSubmit']))
{
  $seviye = postValues($_POST['Seviye']);
  
  $query_rsUyeSeviyeDuzenle = "UPDATE uye_seviye SET Seviye='$seviye' "
          . "WHERE SeviyeID='$seviyeID'";
  
  $sonuc = mysql_query($query_rsUyeSeviyeDuzenle);
  if($sonuc)
  {
      header("Location:index.php?Isltem=Duzenle");
      exit();
  }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Üye Seviye Düzenle</title>
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
    <h1>Üye Seviye Düzenle</h1>
    <?php
    // put your code here
    ?>
    <form action="<?= $_SERVER['PHP_SELF'];?>?SeviyeID=<?= $seviyeID;?>" method="post">
        <fieldset>
        <legend>Seviye Bilgileri</legend>
        <label for="Seviye">Seviye</label>
        <input type="text" name="Seviye" id="Seviye" value="<?= $row_rsUyeSeviye->Seviye;?>"/>
        <br>
        <input type="submit" name="uyeSeviyeDuzenleSubmit" value="Değişiklikleri Kaydet"/>
        </fieldset>
    </form>
</body>
</html>
