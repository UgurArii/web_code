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
$modulID = 9;
$alan = 'Sil';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('urun')==0){
    header("Location:../index.php?Hata=PasifModul");
}

if(isset($_GET['UrunID']))
{
    $urunID = getValues($_GET['UrunID']);
    $query_UrunResim = "SELECT UrunResim FROM urun WHERE UrunID='$urunID'";
    $row_rsUrun = mysql_fetch_object(mysql_query($query_UrunResim));
    
    $query_UrunSil = "DELETE FROM urun WHERE UrunID='$urunID'";
    $sonuc = mysql_query($query_UrunSil);
    
    if($sonuc){
        if(!empty($row_rsUrun->UrunResim))
        {
            $silinecekResim = "../../uploads/urun/".$row_rsUrun->UrunResim;
            $silmeSonuc = unlink($silinecekResim);
            if($silmeSonuc)
            {
                header("Location:index.php?Islem=UrunSil&ResimSil=Basarili");
            }
        }else{
                header("Location:index.php?Islem=UrunSil");
            }
        }
    
}else{
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php
    // put your code here
    ?>
</body>
</html>
