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
urun.KategoriID,
urun.Indirim,
urun.IndirimliFiyat
FROM
urun_kdv as UrunKDV,
urun
INNER JOIN urun_kdv ON urun.KdvID = urun_kdv.KdvID
INNER JOIN urun_kategori ON urun.KategoriID = urun_kategori.KategoriID
WHERE UrunArsiv!=1
ORDER BY UrunID DESC
";

$rsUrun = mysql_query($query_Urun);
$row_rsUrun = mysql_fetch_object($rsUrun);
$num_row_rsUrun = mysql_num_rows($rsUrun);

function urun_profil_varmi($urunID){
    $query = "SELECT * FROM urun_profil WHERE UrunID = '$urunID'";
    $result = mysql_query($query);
    $num_row = mysql_num_rows($result);
    return $num_row;
}

function profilIDBul($urunID){
    $query = "SELECT * FROM urun_profil WHERE UrunID = '$urunID'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    
    $profilID = $row->UrunProfilID;
    
    return $profilID;
}
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
     <?php require '../_inc/header.php';?>  
    </header>
    <nav>
    <?php require '../_inc/nav.php';?>   
    </nav>
<section>
     <h1>Ürünler</h1>
    <?php
   echo "<p>Kayıtlı Ürün Sayısı $num_row_rsUrun</p>";
    ?>
     <p><a href="ekle.php" >Ürün Ekle</a>   |   <a href="arsiv.php">Arşiv Göster</a> | <a href="index.php">Tüm Ürünleri Göster</a></p>
    <table id="dinamikListe">
        <tr>
            <th>Ürün Resim</th>
            <th>Ürün Adı</th>
            <th>Kategori</th>
            <th>Ürün Fiyat</th>
            <th>İndirimli Fiyat</th>
            <th>İndirim</th>
            <th>Kdv</th>
            <th>Aktif</th>
            <th>Tarih</th>
            <th>Düzenle</th>
        </tr>
        <?php do{ ?>
         <?php if(urun_profil_varmi($row_rsUrun->UrunID)!=0) :?>
        <tr>
            <td><img class ="UrunResim" src="../../_uploads/resim/urun/<?= $row_rsUrun->UrunResim ;?>" width="75"  /></td>
            <td> 
                <a href="duzenle.php?UrunID=<?= $row_rsUrun->UrunID;?>"><?= $row_rsUrun->UrunAdi ;?> </a> 
            </td>
            <td><?= $row_rsUrun->Kategori ;?></td>
            <td><?= $row_rsUrun->UrunFiyat ;?></td>
            <td><?= $row_rsUrun->IndirimliFiyat ;?></td>
            <td>
                <?php
            if($row_rsUrun->Indirim==1)  : ?>
            <img src="../../_img/icon/aktif-icon.png" height="25" />
       
            <?php else :?>
            <img src="../../_img/icon/pasif-icon.png" height="25" />
                 <?php endif;?>
            </td>
            <td><?= $row_rsUrun->Kdv ;?></td>
            <td>
                <?php
            if($row_rsUrun->UrunAktif==1)  : ?>
            <img src="../../_img/icon/aktif-icon.png" height="25" />
       
            <?php else :?>
            <img src="../../_img/icon/pasif-icon.png" height="25" />
                 <?php endif;?>
            </td>
            <td width="125"><?= date("d/m/Y H:i", strtotime($row_rsUrun->UrunTarih)) ;?></td>
            <td width="200" class="buton">
                <?php $profilVarmi = urun_profil_varmi($row_rsUrun->UrunID);
                ?>
                <?php if(!$profilVarmi) :?>
                <a href="../urun_profil/ekle.php?UrunID=<?= $row_rsUrun->UrunID;?>">Profil Ekle</a>
                <?php else:?>
                <a href="../urun_profil/duzenle.php?ProfilID=<?= profilIDBul($row_rsUrun->UrunID);?>">Profil Ekle</a>
                <?php endIf;?>
                <a href="duzenle.php?UrunID=<?= $row_rsUrun->UrunID ;?>">Düzenle</a> 
                <a href="arsivle.php?UrunID=<?= $row_rsUrun->UrunID ;?>">Arşivle</a> 
            </td>
        </tr>
            <?php endif;?>
        <?php }while($row_rsUrun=  mysql_fetch_object($rsUrun)); ?>
    </table>
    <p><a href="ekle.php" >Ürün Ekle</a></p>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
