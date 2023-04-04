<?php 
require_once '../../_inc/connection.php';
require_once '../_inc/genel/functions.php';
require_once '../_inc/uyelik/functions.php';
require_once '../_inc/siparis/functions.php';
$yetki = yetkiVarmi($_SESSION['UyeID']);

if($yetki>1){
    header("Location:../../uye-giris.php?Hata=YetkisizKullanici");
    exit();
}

//siparisId alınır
$siparisID = mysql_real_escape_string($_GET['SiparisID']);
$uyeID = sipariseGoreUyeIDBul($siparisID);

//üye giriş kayıt setinin yapılması
$query_rsUyeGiris = "SELECT * FROM uye_giris WHERE UyeID='$uyeID'";
$rsUyeGiris = mysql_query($query_rsUyeGiris);
$row_rsUyeGiris = mysql_fetch_object($rsUyeGiris);

//Sipariş Bilgileri Kayıt Seti
$query_rsSiparis = "SELECT * FROM siparis WHERE SiparisID = '$siparisID'";
$rsSiparis = mysql_query($query_rsSiparis);
$row_rsSiparis = mysql_fetch_object($rsSiparis);

//siparişteki ürünler için kayıt seti
$query_rsSiparisUrun = "SELECT * FROM siparis_urun 
         INNER JOIN urun ON siparis_urun.UrunID = urun.UrunID
          INNER JOIN urun_kategori ON urun.KategoriID = urun_kategori.KategoriID
         INNER JOIN urun_kdv ON urun.KdvID = urun_kdv.KdvID
         WHERE SiparisID = '$siparisID'";
$rsSiparisUrun = mysql_query($query_rsSiparisUrun);
$row_rsSiparisUrun = mysql_fetch_object($rsSiparisUrun);
$num_row_rsSiparisUrun = mysql_num_rows($rsSiparisUrun)

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Sipariş Detayı </title>
      <link  href="../_css/tema/panel/style.css" rel="stylesheet" type="text/css" />
    <link href="../_css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
    <link href="../_css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css"/>
    <script src="../_js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="../_js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
    <script src="../_js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="../_js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
    <script src="../../_inc/js/highslide/highslide-with-full.js" type="text/javascript"></script>
    <link href="../../_inc/js/highslide/highslide.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">
    hs.graphicsDir = "../../_inc/js/highslide/graphics/";
    hs.outlineType = 'rounded-white';
    hs.wrapperClassName = 'draggable-header';
    </script>
      <script type="text/javascript">


$(function() {


$( "#tabs" ).tabs();

$("tr.siparis:even").addClass("ciftSatir");
$("tr.siparis:odd").addClass("tekSatir");

$(" tr.siparis").hover(
    function(){
        $(this).toggleClass("uzerindeyken");
    }
    ,
    function (){
        $(this).toggleClass("uzerindeyken");
    }
);

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
     
    <h1>Sipariş Detayı</h1>
    <div class="bilgiKutu">
        <h2>Sipariş Detayı Adımları</h2>
        <ul>
            <li>1. Üye Giriş Bilgileri</li>
            <li>2. Üye Profil Bilgileri</li>
            <li>3. Siparişteki Ürünler</li>
            <li>4. Ödeme</li>
        </ul>
    </div>
    <div class="bilgiKutu">
        <h2>1.Sipariş Veren Üyenin Giriş Bilgileri</h2>
        <ul>
            <li><span>Kullanıcı Adı:</span> <?=$row_rsUyeGiris->KullaniciAdi;?> </li>
            <li><span>Eposta :</span> <?=$row_rsUyeGiris->Eposta;?></li>
            <li><span>Kayıt Tarihi :</span> <?= date("d/m/Y",  strtotime($row_rsUyeGiris->KayitTarih));?></li>
        </ul>
    </div>
   
    <div class="bilgiKutu">
        <h2>2.Sipariş Bilgileri</h2>
        <ul>
            <li><span>Sipariş ID :</span><?= $row_rsSiparis->SiparisID;?></li>
            <li><span>Sipariş Code :</span><?= $row_rsSiparis->SiparisCode;?></li>
            <li><span>Toplam Ürün :</span><?= $row_rsSiparis->ToplamUrun;?></li>
            <li><span>Toplam Fiyat :</span><?= $row_rsSiparis->ToplamFiyat;?></li>
            <li><span>Ödeme :</span>
            <?php if($row_rsSiparis->Odeme==0):?>
            <img src="../../_img/icon/pasif-icon.png" width="25"/>
            <?php else:?>
            <img src="../../_img/icon/aktif-icon.png" width="25"/>
            <?php  endif;?>
            </li>
             <li><span>Sipariş Tarih :</span><?= date("d/m/Y H.m:i",  strtotime($row_rsSiparis->SiparisTarih));?></li>
        </ul>
    </div>
    
    <div class="bilgiKutu">
        <h2>Siparişteki Ürünler</h2>
        <p>Toplam Farklı Ürün Sayısı : <strong><?= $num_row_rsSiparisUrun;?> Ürün</strong></p>
         <p>Toplam Ürün Adeti : <strong><?= $row_rsSiparis->ToplamUrun;?> Adet</strong></p>
         <table id="dinamikListe">
             <tr>
                 <th>Ürün ID</th>
                 <th>Ürün Resim</th>
                 <th>Ürün Adı</th>
                 <th>Ürün Miktar</th>
                 <th>Ürün Fiyat</th>
                 <th>Toplam Fiyat</th>
                 <th>Kategori</th>
             </tr>
             
             <?php do{ ?>
             <tr class="siparis">
                 <td><?= $row_rsSiparisUrun->UrunID;?></td>
                 <td><img src="../../_uploads/resim/urun/<?= $row_rsSiparisUrun->UrunResim;?>" height="50"/></td>
                 <td class="alignLeft"><?= $row_rsSiparisUrun->UrunAdi;?></td>
                 <td><?= $row_rsSiparisUrun->UrunMiktar;?></td>
                 <td><?= $row_rsSiparisUrun->UrunFiyat;?> TL</td>
                 <td><?= $row_rsSiparisUrun->UrunMiktar * $row_rsSiparisUrun->UrunFiyat;?> TL</td>
                 <td><?= $row_rsSiparisUrun->Kategori;?></td>
             </tr>
             <?php  } while($row_rsSiparisUrun = mysql_fetch_object($rsSiparisUrun));?>
         </table>
    </div>
     <br/>
</section>
     
<footer>

</footer>
</body>
</html>
