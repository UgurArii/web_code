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

//modul id değerinin alınması
$modulID = getValues($_GET['ModulID']);

//modul kayıt seti
$query_rsModul = "SEŞECT ModulID, ModulResim FROM modul WHERE ModulID='$modulID'";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);

//query oluşturulması
$query_ModulSil = "DELETE FROM modul WHERE ModulID='$modulID'";
$sonuc = mysql_query($query_ModulSil);

//eğer modül silindiyse
if($sonuc){
    $filename = "../../uploads/img/modul/".$row_rsModul->ModulResim;
    $resimSil = unlink($filename);
    
    if($resimSil)
    {
        header("Location:index.php?Islem=ModulSil");
    }
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
