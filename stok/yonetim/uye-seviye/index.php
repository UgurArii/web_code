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
$alan = 'Listele';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('uye-seviye')==0){
    header("Location:../index.php?Hata=PasifModul");
}

//üye seviye kayıt seti
$query_rsUyeSeviye = "SELECT * FROM uye_seviye";
$rsUyeSeviye = mysql_query($query_rsUyeSeviye);
$row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye);
$num_row_rsUyeSeviye = mysql_num_rows($rsUyeSeviye);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Üye Seviyeleri</title>
     <script src="../../includes/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function(){
         //css özellikleri even-odd
         $("#SeviyeListe tr.listeVeri:even").addClass("evenTR");
         $("#SeviyeListe tr.listeVeri:odd").addClass("oddTR");
         //saturun üzerine gelince highlight effect 
         $("#SeviyeListe tr.listeVeri").hover(
                 function(){
                   $(this).toggleClass("highlightTR");  
                 },
                 function(){
                     $(this).toggleClass("highlightTR");
                 }
                );
         
      });
    </script>
     <style>
        .evenTR{
            background-color: #edf4f6;
            
        }
        .oddTR{
            background-color: #ccf0f9;
            
        }
        .highlightTR{
            background-color: #f1fde3;
            cursor: pointer;
        }
        #SeviyeListe tr th{
            background-color: #f00;
            color:#fff;
            padding: 5px;
            text-align: left;
        }
        #SeviyeListe tr td{
            padding: 5px;
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
    <?php
    // put your code here
    ?>
    <h1>Üye Seviye Bilgileri</h1>
    <a href="ekle.php">Seviye Ekle</a>
    <table id="SeviyeListe">
        <tr>
            <th>Seviye ID</th>
            <th>Seviye</th>
            <th>Düzenle</th>            
        </tr>
    <?php do {?>
        <tr class="listeVeri">
            <td><?= $row_rsUyeSeviye->SeviyeID;?></td>
            <td><?= $row_rsUyeSeviye->Seviye;?></td>
            <td>
                <a href="duzenle.php?SeviyeID=<?= $row_rsUyeSeviye->SeviyeID ;?>">Düzenle</a>
                |
               
                <a href="sil.php?SeviyeID=<?= $row_rsUyeSeviye->SeviyeID ;?>">Sil</a>
            </td>
        </tr>
    <?php } while($row_rsUyeSeviye = mysql_fetch_object($rsUyeSeviye));?>
    </table>
    </body>
</html>
