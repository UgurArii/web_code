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
$modulID = 14;
$alan = 'Listele';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

//cari adres tipleri kayıt seti
$query_rsCariAdresTip = "SELECT * FROM cari_adres_tip ORDER BY AdresTip ASC";
$rsCariAdresTip = mysql_query($query_rsCariAdresTip);
$row_rsCariAdresTip = mysql_fetch_object($rsCariAdresTip);
$num_rows_rsCariAdresTip = mysql_num_rows($rsCariAdresTip);

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
    <title>Cari Adres Tipleri</title>
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
    <h1>Cari Adres Tipleri</h1>
    <a href="ekle.php">Cari Adres Tipi Ekle</a>
     <?php
   if(isset($_GET['Islem']) && $_GET['CariAdresTipEkle'])
   {
       echo "<p>Cari adres tipi başarıyla eklendi</p>";
       
   }elseif(isset ($_GET['Islem']) && $_GET['Islem']=='CariAdresTipSil'){
       echo "<p>Cari Tip Sayısı: $num_row_rsCariTip</p>";
   }elseif(isset ($_GET['Islem']) && $_GET['Islem']=='CariAdresTipDuzenle'){
       echo "<p>Cari Tip başarıyla düzenlendi</p>";
   }
    echo "<p>Cari Tip Sayısı: $num_row_rsCariTip</p>";
    ?>
    <?php if($num_rows_rsCariAdresTip!=0):?>
    <?php
    echo "<p><strong>Cari Adres Tipi Sayısı: $num_rows_rsCariAdresTip</strong></p>";
    ?>
    <table id="dinamikTablo">
        <tr>
            <th>Cari Adres</th>
            <th>Düzenle</th>
        </tr>
        <?php do{?>
        <tr class="listeVeri">
            <td><?= $row_rsCariAdresTip->AdresTip;?></td>
            <td>
            <a href="duzenle.php?AdresTipID=<?=$row_rsCariAdresTip->AdresTipID;?>">Düzenle</a>
            |
             <a href="sil.php?AdresTipID=<?=$row_rsCariAdresTip->AdresTipID;?>">Sil</a>
            </td>
        </tr>
        <?php }while($row_rsCariAdresTip=  mysql_fetch_object($rsCariAdresTip));?>
    </table>
    <?php    endif;?>
</body>
</html>
