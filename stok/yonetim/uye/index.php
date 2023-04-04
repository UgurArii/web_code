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
$alan = 'Listele';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('uye')==0){
    header("Location:../index.php?Hata=PasifModul");
}

//kayıt eti oluşturulması
 $query_rsUye = "SELECT 
uye_seviye.Seviye,
uye.Aktif,
uye.Eposta,
uye.KullaniciAdi,
uye.UyeID,        
uye.KayitTarih,        
uye.KayitIP,        
uye.SeviyeID   
FROM
uye
INNER JOIN uye_seviye ON uye.SeviyeID = uye_seviye.SeviyeID";

 $rsUye = mysql_query($query_rsUye);
 $row_rsUye = mysql_fetch_object($rsUye);
 $num_row_rsUye = mysql_num_rows($rsUye);
 
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
    <title>Üye Listesi</title>
    <script src="../../includes/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function(){
         //css özellikleri even-odd
         $("#UyeListe tr.listeVeri:even").addClass("evenTR");
         $("#UyeListe tr.listeVeri:odd").addClass("oddTR");
         //saturun üzerine gelince highlight effect 
         $("#UyeListe tr.listeVeri").hover(
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
        #UyeListe tr th{
            background-color: #f00;
            color:#fff;
            padding: 5px;
            text-align: left;
        }
        
        #UyeListe tr td{
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
    <h1>Üye Listesi</h1>
<img src="../../includes/img/ekle.png" alt=""/><a href="ekle.php">Üye Ekle</a>
    <?php
    if(isset($_GET['Islem']))
    {
        if($_GET['Islem']=='UyeEkle')
        echo "<p>Üye Başarıyla Eklendi</p>";
           
        
        if($_GET['Islem']=='UyeSil')
        echo "<p>Üye Başarıyla Silindi</p>";
        
           if($_GET['Islem']=='UyeDuzenle')
        echo "<p>Üye Başarıyla Düzenle</p>";
    }
    if(isset($_GET['Hata']))
    {
         if($_GET['Hata']=='AnaHesap')
            {
                echo "<p><strong>Bu üye silinemez</strong></p>";
            }
    }
    echo "<p>Toplam Üye Sayısı $num_row_rsUye</p>";
    
    
    ?>
    <table id="UyeListe">
        <tr>
        <th>Kullanıcı Adı</th>
        <th>Yetki</th>
        <th>Eposta</th>
        <th>Seviye</th>
        <th>Aktif</th>
        <th>Kayıt IP</th>
        <th>Kayıt Tarih</th>
        <th>Düzenle</th>
        </tr>
        <?php do {?>
        <tr class="listeVeri">
            <td><?= $row_rsUye->KullaniciAdi;?></td>
            <td><a href="../_modul-uye/index.php?UyeID=<?=$row_rsUye->UyeID;?>">Yetkilerini Göster</a></td>
            <td><?= $row_rsUye->Eposta;?></td>
            <td><?= $row_rsUye->Seviye;?></td>
            <td><?php if($row_rsUye->Aktif==1):?>
        <img src="../../includes/img/aktif.png" alt=""/>
        <?php else:?>
        <img src="../../includes/img/pasif.png" alt=""/>
        <?php endif;?>
            </td>
            <td><?= $row_rsUye->KayitIP;?></td>
            <td><?= date("d/m/Y H:i:s",  strtotime($row_rsUye->KayitTarih));?></td>
            <td>
                <a href="duzenle.php?UyeID=<?= $row_rsUye->UyeID;?>">Düzenle</a>
                <?php if($row_rsUye->UyeID!=1):?>
                <a href="sil.php?UyeID=<?= $row_rsUye->UyeID;?>">Sil</a>
                <?php endif;?>
       </tr>
        <?php }while($row_rsUye = mysql_fetch_object($rsUye));?>
    </table>
</body>
</html>
