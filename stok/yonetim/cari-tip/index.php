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
$modulID = 12;
$alan = 'Listele';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

$query_rsCariTip = "SELECT * FROM cari_tip ORDER BY Tip ASC";
$rsCariTip = mysql_query($query_rsCariTip);
$row_rsCariTip = mysql_fetch_object($rsCariTip);
$num_row_rsCariTip = mysql_num_rows($rsCariTip);

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
    <title></title>
    <script src="../../includes/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function(){
         //css özellikleri even-odd
         $("#dinamikTablo tr.listeVeri:even").addClass("evenTR");
         $("#dinamikTablo tr.listeVeri:odd").addClass("oddTR");
         //saturun üzerine gelince highlight effect 
         $("#dinamikTablo tr.listeVeri").hover(
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
        #dinamikTablo tr th{
            background-color: #f00;
            color:#fff;
            padding: 5px;
            text-align: left;
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
    <h1>Cari Tipleri</h1>
    <?php
   if(isset($_GET['Islem']) && $_GET['CariTipEkle'])
   {
       echo "<p>Cari tipi başarıyla eklendi</p>";
       
   }elseif(isset ($_GET['Islem']) && $_GET['Islem']=='CariSil'){
       echo "<p>Cari Tip Sayısı: $num_row_rsCariTip</p>";
   }elseif(isset ($_GET['Islem']) && $_GET['Islem']=='CariDuzenle'){
       echo "<p>Cari Tip başarıyla düzenlendi</p>";
   }
    echo "<p>Cari Tip Sayısı: $num_row_rsCariTip</p>";
    ?>
    <table id="dinamikTablo">
        <tr>
            <th>Tip</th>
            <th>Düzenle</th>
        </tr>
        <?php do {?>
        <tr class="listeVeri">
            <td><?= $row_rsCariTip->Tip;?></td>
            <td><a href="duzenle.php?TipID=<?= $row_rsCariTip->TipID;?>">Düzenşe</a> |
                <a href="sil.php?TipID=<?= $row_rsCariTip->TipID;?>">Sil</a></td>
        </tr>
        <?php }while($row_rsCariTip=  mysql_fetch_object($rsCariTip));?>
    </table>
</body>
</html>
