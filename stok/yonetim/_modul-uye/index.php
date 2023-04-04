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
    header("Location:../index.php?Hata=YetkisizGiris");
}

$yetkilenecekUyeID = getValues($_GET['UyeID']);

$query_rsUye = "SELECT KullaniciAdi, UyeID FROM uye WHERE UyeID='$yetkilenecekUyeID'";
$row_rsUye = mysql_fetch_object(mysql_query($query_rsUye));

$query_rsModulUye = "SELECT modul_uye.ModulID, modul.ModulID, modul.ModulAdi, modul_uye.UyeID, modul_uye.Ekle, modul_uye.Duzenle, modul_uye.Sil, modul_uye.Listele, modul.ModulResim FROM modul_uye INNER JOIN modul ON modul_uye ModulID = modul.ModulID WHERE modul_uye UyeID='$uyeID'";
$rsModulUye = mysql_query($query_rsModulUye);
$row_rsModulUye = mysql_fetch_object($rsModulUye);
$num_row_rsModulUye = mysql_num_rows($rsModulUye);
//do{
//    echo "ModulID: $row_rsModulUye->ModulID<br>";
//    echo "Modul Adı: $row_rsModulUye->ModulAdi<br>";
//}while($row_rsModulUye=mysql_fetch_object($rsModulUye));



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
        #dinamikTablo tr td{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Üyenin Yetkili Olduğu Modülleri</h1>
    <p><strong>Üyelik Adı: <?= $row_rsUye->KullaniciAdi;?></strong></p>
    <p><a href="duzenle.php?UyeID=<?= $uyeID;?>">Yetkileri Düzenle</a></p>
    <?php if($num_row_rsModulUye!=0):?>
    <table id="dinamikTablo">
        <tr>
            <th>Modül ID</th>
            <th>Modül Resim</th>
            <th>Ekle</th>
            <th>Düzenle</th>
            <th>Sil</th>
            <th>Listele</th>
            <th>Düzenle</th>
        </tr>    
        
        <?php do{?>
        <tr class="listeVeri">
            <td><?= $row_rsModulUye->ModulID;?></td>
            <td><img src="../../uploads/modul/<?= $row_rsModulUye->ModulResim;?>" width="75"/></td>
            <td><?= $row_rsModulUye->ModulAdi;?></td>
            <td>
                <?php if($row_rsModulUye->Ekle==1):?>                
                <a href="yetkile.php?UyeID<?= $uyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>&Alan=Ekle&Deger=0"> <img src="../../includes/img/_aktif.png"/></a>
            <?php else:?>
                <a href="yetkile.php?UyeID<?= $uyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>&Alan=Ekle&Deger=1"> <img src="../../includes/img/_pasif.png"/></a>
          
            <?php endif;?>
            </td>
            <td>
                <?php if($row_rsModulUye->Duzenle==1):?>                
             <a href="yetkile.php?UyeID<?= $uyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>&Alan=Ekle&Duzenle=0"> <img src="../../includes/img/_aktif.png"/></a>
            <?php else:?>
                <a href="yetkile.php?UyeID<?= $uyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>&Alan=Ekle&Duzenle=1"> <img src="../../includes/img/_pasif.png"/></a>
           <?php endif;?>
            </td>
            <td>
                <?php if($row_rsModulUye->Sil==1):?>                
             <a href="yetkile.php?UyeID<?= $uyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>&Alan=Ekle&Sil=0"> <img src="../../includes/img/_aktif.png"/></a>
            <?php else:?>
                <a href="yetkile.php?UyeID<?= $uyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>&Alan=Ekle&Sil=1"> <img src="../../includes/img/_pasif.png"/></a>
           <?php endif;?>
            </td>
            <td>
                <?php if($row_rsModulUye->Listele==1):?>                
              <a href="yetkile.php?UyeID<?= $uyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>&Alan=Ekle&Listele=0"> <img src="../../includes/img/_aktif.png"/></a>
            <?php else:?>
                <a href="yetkile.php?UyeID<?= $uyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>&Alan=Ekle&Listele=1"> <img src="../../includes/img/_pasif.png"/></a>
           <?php endif;?>
            </td>
            <td><a href="sil.php?UyeID=<?= $row_rsModulUye->UyeID;?>&ModulID=<?= $row_rsModulUye->ModulID;?>">Sil</a>
                
            </td>
        </tr>    
        <?php }while($row_rsModulUye= mysql_fetch_object($rsModulUye));?>
        <?php else:?>
        <p>Henüz yetkisi bulunmamaktadır.</p>
        <a href="../_modul-uye/ekle.php?UyeID=<?= $uyeID;?>">Yetki Ekle</a>
        <?php endif;?>
    </table>
    
</body>
</html>
