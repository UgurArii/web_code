<?php 
require_once '../../_inc/connection.php';
require_once '../_inc/uyelik/functions.php';
if(!isset($_SESSION['UyeID'])){
    header("Location:../giris.php?GirisYap");
}
$yetki = yetkiVarmi($_SESSION['UyeID']);

if($yetki>1){
    header("Location:../../uye-giris.php?Hata=YetkisizKullanici");
}
$query_rsUrunProfil = "SELECT
       urun.UrunFiyat,
       urun.UrunAdi,
       urun.UrunResim,
       urun.UrunAktif,
       urun.UrunID,
       urun_profil.UrunProfilID,
       urun_profil.UrunID,
       urun_profil.MarkaID,
       urun_profil.UrunPuan,
       urun_profil.HediyePuan,
       urun_profil.Goruntulenme,
       urun_profil.Aktif,
       urun_profil.ProfilTarih,
       urun_marka.MarkaID,
       urun_marka.Marka,
       urun_marka.MarkaLogo,
       urun_marka.HarfID,
       urun_marka.Listeleme
       FROM
       urun
       INNER JOIN urun_profil ON urun.UrunID = urun_profil.UrunID
       INNER JOIN urun_marka ON urun_profil.MarkaID = urun_marka.MarkaID
        ";

    $rsUrunProfil = mysql_query($query_rsUrunProfil);
    $row_rsUrunProfil = mysql_fetch_object($rsUrunProfil);
    $num_row_rsUrunProfil  = mysql_num_rows($rsUrunProfil);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Profil Anasayfa </title>
    <link  href="../_css/tema/panel/style.css" rel="stylesheet" type="text/css" />
    <link href="../_css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
    <script src="../_js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="../_js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
    <script type="text/javascript">


$(function() {


$( "#tabs" ).tabs();




});
    </script>
</head>
<body>
  
      <header>
     <?php require '../_inc/header.php';?>  
    </header>
    <nav>
    <?php require '../_inc/nav.php';?>   
    </nav>
<section>
    
    <h1>Ürün Profilleri</h1>
    <?php if(isset($_GET['Islem'])){$islem = $_GET['Islem'];} else{$islem = ' ';};?>
    
    <?php if($islem == 'ProfilDuzenle') :?>
    <div class="yesilKutu">
    <p><strong>Ürün Profil Başarıyla Düzenlendi</strong></p>
    </div>
    <?php elseif($islem=="UrunProfilEkle"):?>
      <div class="yesilKutu">
    <p><strong>Ürün Profil Başarıyla Ekle</strong></p>
      </div>
    <?php elseif($islem=="UrunProfilSil"):?>
      <div class="yesilKutu">
    <p><strong>Ürün Profil Başarıyla Silindi</strong></p>
      </div>
    <?php endif;?>
    
    <?= "<p>Toplam Ürün Profil Sayısı : $num_row_rsUrunProfil</p>";?>
    <table id="dinamikListe">
             <tr>
            <th>Ürün Resim</th>
            <th>Ürün Adı</th>
            <th>Marka</th>
            <th>Ürün Fiyatı</th>
            <th>Ürün Aktif</th>
            <th>Hediye Puanı</th>
            <th>Ürün Puanı</th>
            <th>Görüntülenme</th>
            <th>Profil Aktif</th>
            <th>Profil Tarih</th>
            <th>Düzenle</th>
        </tr>
       <?php do{ ?>
        <tr>
            <td><img src="../../_uploads/resim/urun/<?= $row_rsUrunProfil->UrunResim;?>" width="50"/></td>
            <td><?= $row_rsUrunProfil->UrunAdi;?></td>
            <td><?= $row_rsUrunProfil->Marka;?></td>
            <td><?= $row_rsUrunProfil->UrunFiyat;?></td>
            
         <td>
                <?php
            if($row_rsUrunProfil->UrunAktif==1)  :?>
         <img src="../../_img/icon/aktif-icon.png" width="25"/>
            <?php else :?>
         <img src="../../_img/icon/pasif-icon.png" width="25"/>
                 <?php endif;?>
            </td>
            <td><?= $row_rsUrunProfil->HediyePuan;?></td>
            <td><?= $row_rsUrunProfil->UrunPuan;?></td>
            <td><?= $row_rsUrunProfil->Goruntulenme;?></td>
            <td>
                     <?php
            if($row_rsUrunProfil->UrunAktif==1)  :?>
         <img src="../../_img/icon/aktif-icon.png" width="25"/>
            <?php else :?>
         <img src="../../_img/icon/pasif-icon.png" width="25"/>
                 <?php endif;?>
            </td>
            <td><?= $row_rsUrunProfil->ProfilTarih;?></td>
            <td><a href="duzenle.php?UrunProfilID=<?= $row_rsUrunProfil->UrunProfilID;?>">Düzenle</a> 
                 <a href="sil.php?UrunProfilID=<?= $row_rsUrunProfil->UrunProfilID;?>">Sil</a> 
                </td>
        </tr>
       <?php } while($row_rsUrunProfil = mysql_fetch_object($rsUrunProfil));?>
        
    </table>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
