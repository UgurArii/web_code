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
$alan = 'Listele';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

$query_rsCari = "SELECT 
  cari.CariID, cari.CariKodu, cari.CariAdi,
  cari.Notlar, cari_tip.Tip, cari.Eposta,
  cari.Telefon, cari.VergiDairesi, cari.VergiNo,
  cari_tip.TipID, cari.TipID FROM cari INNER JOIN cari_tip ON cari.TipID = cari_tip.TipID 
  ORDER BY cari.CariID DESC";
  
$rsCari = mysql_query($query_rsCari);
$row_rsCari = mysql_fetch_object($rsCari);
$num_row_rsCari = mysql_num_rows($rsCari);

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
    <title>Cari Listesi</title>
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
    <h1>Cari Listesi</h1>
    <a href="ekle.php">Cari Ekle</a>
    <?php
    if(isset($_GET['Islem'])){
        $islem = $_GET['Islem'];
        switch ($_GET){
            case 'CariEkle':
             echo "<p><strong>Cari Başarıyla Eklendi</strong></p>";
             break;
          case 'CariDuzenle':
             echo "<p><strong>Cari Başarıyla Düzenlendi</strong></p>";
             break;
          case 'CariSil':
             echo "<p><strong>Cari Başarıyla Silindi</strong></p>";
             break;
         default :
             break;
         
        }
    }
     ?>
   <?php
   if($num_row_rsCari!=0):?>
    <?php    echo "<p><strong>Cari Sayısı: $num_row_rsCari</strong></p>";?>
    <table id="dinamikTablo">
        <tr>
            <th>Cari Kodu</th> 
            <th>Cari Adı</th> 
            <th>Cari Tipi</th>
            <th>Eposta</th> 
            <th>Telefon</th> 
            <th>Vergi Dairesi</th> 
            <th>Vergi No</th> 
            <th>Düzenle</th> 
        </tr>
        <?php do{?>
        <tr class="listeVeri">
            <td><?= $row_rsCari->CariKodu;?></td>
            <td><?= $row_rsCari->CariAdi;?><br>
            <?= $row_rsCari->Notlar;?></td>
            <td><?= $row_rsCari->Tip;?></td>
            <td><?= $row_rsCari->Eposta;?></td>
            <td><?= $row_rsCari->Telefon;?></td>
            <td><?= $row_rsCari->VergiDairesi;?></td>
            <td><?= $row_rsCari->VergiNo;?></td>
            <td>
                <a href="duzenle.php?CariID<?= $row_rsCari->CariID;?>">Düzenle</a>
                |
                <a href="sil.php?CariID=<?= $row_rsCari->CariID;?>">Sil</a>
            </td>
        </tr>
        <?php }while($row_rsCari=  mysql_fetch_object($rsCari));?>
        
    </table>
    <?php endif;?>
</body>
</html>
