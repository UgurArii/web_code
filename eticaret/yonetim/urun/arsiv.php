<?php 
require_once '../../_inc/connection.php';

//ürün kayıt setinin oluşturulması
$query_Urun ="SELECT DISTINCT
urun.UrunResim,
urun.UrunAdi,
urun_kategori.Kategori,
urun.UrunFiyat,
urun_kdv.Kdv,
urun.UrunAktif,
urun.UrunTarih,
urun_kdv.KdvID,
urun.UrunID,
urun.KategoriID
FROM
urun_kdv as UrunKDV,
urun
INNER JOIN urun_kdv ON urun.KdvID = urun_kdv.KdvID
INNER JOIN urun_kategori ON urun.KategoriID = urun_kategori.KategoriID
WHERE UrunArsiv =1";

$rsUrun = mysql_query($query_Urun);
$row_rsUrun = mysql_fetch_object($rsUrun);
$num_row_rsUrun = mysql_num_rows($rsUrun);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürünler</title>
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
        <h1>Panel</h1>
        <div id="kullaniciLogin">            
          <img src="../../_uploads/resim/uye/seviye/_kullanici.png" alt=""/> Kullanıcı Adı            
          <img src="../../_uploads/resim/uye/seviye/logout.png" alt=""/>Çıkış
        </div>
    </header>
    <nav>
     
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Ürün Temel</a></li>
		<li><a href="#tabs-2">Ürün Detay</a></li>
		<li><a href="#tabs-3">Üyelik</a></li>
	</ul>
	<div id="tabs-1">
            <table id="dinamikListe">
                <tr>
                    <td><h3>Ürün</h3></td>
                    <td></td>
                     <td></td>
                    <td><h3>Gösterim Türü</h3></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><img src="../../img/layout/_ekle.png" /><a href="../urun/ekle.php">Ekle</a></td> 
                    <td><img src="../../img/layout/_duzenle.png" /><a href="../urun/index.php">Düzenle</td>
                    <td>&nbsp;</td>
                    <td><img src="../../img/layout/_ekle.png" /><a href="../urun_gosterim_turu/ekle.php">Ekle</td> 
                    <td><img src="../../img/layout/_duzenle.png" /><a href="../urun_gosterim_turu/index.php">Düzenle</td>
                    
                    <td></td>
                 </tr>
                 <tr>
                     <td><h3>Ürün Kategori</h3></td>
                     <td></td>
                     <td></td>
                     <td>    </td>
                     <td></td>
                     <td></td>
                 </tr>
                <tr>
                    <td><img src="../../img/layout/_ekle.png" /><a href="../urun_kategori/ekle.php">Ekle</td> 
                    <td><img src="../../img/layout/_duzenle.png" /><a href="../urun_kategori/index.php">Düzenle</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                   <tr>
                       <td><h3>Ürün KDV</h3></td>
                       <td></td>
                       <td></td>
                       <td>    </td>
                       <td></td>
                       <td></td>
                   </tr>
                    <tr>
                        <td><img src="../../img/layout/_ekle.png" /><a href="../urun_kdv/ekle.php">Ekle</td>
                        <td><img src="../../img/layout/_duzenle.png" /><a href="../urun_kdv/index.php">Düzenle</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
            </table>
                                
                 .</div>
	<div id="tabs-2">Phasellus mattis tincidunt nibh. Cras orci urna, blandit id, pretium vel, aliquet ornare, felis. Maecenas scelerisque sem non nisl. Fusce sed lorem in enim dictum bibendum.</div>
	<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
</div>



<!-- ui-dialog -->
    </nav>
<section>
      <h1>Ürünler</h1>
    <?php
   echo "<p>Kayıtlı Ürün Sayısı $num_row_rsUrun</p>";
    ?>
    <p><a href="ekle.php" >Ürün Ekle</a>   |   <a href="index.php">Ürünleri Göster</a></p>
    <table id="dinamikListe">
        <tr>
            <th>Ürün Resim</th>
            <th>Ürün Adı</th>
            <th>Kategori</th>
            <th>Ürün Fiyat</th>
            <th>Kdv</th>
            <th>Aktif</th>
            <th>Tarih</th>
            <th>Düzenle</th>
        </tr>
        <?php do{ ?>
        <tr>
            <td><img class ="UrunResim" src="../../_uploads/resim/urun/<?= $row_rsUrun->UrunResim ;?>" height="75" /></td>
            <td><?= $row_rsUrun->UrunAdi ;?></td>
            <td><?= $row_rsUrun->Kategori ;?></td>
            <td><?= $row_rsUrun->UrunFiyat ;?></td>
            <td><?= $row_rsUrun->Kdv ;?></td>
            <td>
                <?php
            if($row_rsUrun->UrunAktif==1)  : ?>
            <img src="../../_img/icon/aktif-icon.png" height="25" />
       
            <?php else :?>
            <img src="../../_img/icon/pasif-icon.png" height="25" />
                 <?php endif;?>
            </td>
            <td><?= date("d/m/Y H:i", strtotime($row_rsUrun->UrunTarih)) ;?></td>
            <td width="200">
                <a href="duzenle.php?UrunID=<?= $row_rsUrun->UrunID ;?>">Düzenle</a> 
                <a href="arsivden-cikar.php?UrunID=<?= $row_rsUrun->UrunID ;?>">Arşivden Çıkar</a> 
            </td>
        </tr>
        <?php }while($row_rsUrun=  mysql_fetch_object($rsUrun)); ?>
    </table>
    <p><a href="ekle.php" >Ürün Ekle</a></p>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
