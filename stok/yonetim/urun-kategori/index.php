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
if(modulAktifmi('urun-kategori')==0){
    header("Location:../index.php?Hata=PasifModul");
}

//query oluşturma
$query_rsKategori = "SELECT * FROM kategori ORDER BY KategoriID DESC";
$rsKategori = mysql_query($query_rsKategori);
$row_rsKategori  = mysql_fetch_object($rsKategori);
$num_row_rsKategori = mysql_num_rows($rsKategori);

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
    <title>Ürün Kategorileri</title>
      <script src="../../includes/jquery-1.8.2.min.js" type="text/javascript"></script>
     <script type="text/javascript">
      $(function(){
         //css özellikleri even-odd
         $("#UrunKategoroListe tr.listeVeri:even").addClass("evenTR");
         $("#UrunKategoriListe tr.listeVeri:odd").addClass("oddTR");
         //saturun üzerine gelince highlight effect 
         $("#UrunKategoriListe tr.listeVeri").hover(
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
        #UrunKategoriListe tr th{
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
    <?php
    if($num_row_rsKategori !=0){
    echo "<p><strong> $num_row_rsKategori tane kategori bulunmaktadır</strong></p>";
    echo "<p><a href='ekle.php'>Kategori Ekle</a></p>";    
    }else{
        echo "<a href='ekle.php'>Kategori Ekle</a>";
    }
    
 
  if($num_row_rsKategori !=0){?>  
<table id="UrunKategoriListe">
    <tr>
        <th>Resim</th>
        <th>Kategori</th>
         <th>Parent</th>
         <th>Düzenle</th> 
    </tr>
    <?php do{?>
    <tr class="listeVeri">
        <td><img src="../../uploads/urun-kategori/<?= $row_rsKategori->KategoriResim;?>" height="75px"/></td>
         <td><?= $row_rsKategori->Kategori;?></td>
          <td>
        <?php if($row_rsKategori->ParentID==0){
            echo "En Üst Kategori";
        }else{
         echo parentKategoriBul($row_rsKategori->ParentID);    
        }?>
         
          </td>
          <td><a href="ekle.php?ParentID=<?= $row_rsKategori->ParentID;?>">Alt Ekle</a> 
              <a href="duzenle.php?KategoriID=<?= $row_rsKategori->KategoriID;?>">Düzenle</a> 
              
              <?php $urunSayisi = UrunVarmi($row_rsKategori->KategoriID); if($urunSayisi==0):?>
              <a href="sil.php?KategoriID<?= $row_rsKategori->KategoriID;?>">| Sil</a>
              <?php endif;?>
              
          </td>
    </tr>
    <?php }while($row_rsKategori = mysql_fetch_object($rsKategori));?>
</table>
      <?php }?>
</body>
</html>
