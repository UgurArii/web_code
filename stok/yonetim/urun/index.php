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
$modulID = 9;
$alan = 'Listele';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}
//modul aktif mi

if(modulAktifmi('urun')==0){
    header("Location:../index.php?Hata=PasifModul");
}

//ürün kayıt seti

$query_rsUrun = "SELECT
    kategori.Kategori,
    kategori.KategoriResim,
    urun.UrunID,
    urun.StokKodu,
    urun.UrunAdi,
    urun.TurID,
    urun.GosterimTurID,
    urun.UrunResim,
    urun.UyeID,
    urun.UyeIP,
    urun.EklemeTarih
    FROM
    urun
    INNER JOIN kategori ON urun.KategoriID = kategori.KategoriID ";
if(isset($_GET['KategoriID']))
{
    $kategoriID = getValues($_GET['KategoriID']);
    $query_rsUrun.= "WHERE urun.KategoriID='$kategoriID'"; 
}

if(isset($_GET['Sirala'])){
    
if($_GET['Sirala']=='UrunAdi')
{
    if(isset($_GET['Yon']))
    { $query_rsUrun.="ORDER BY urun.UrunAdi DESC ";}
    else{$query_rsUrun.="ORDER BY urun.UrunAdi ASC ";}
}elseif($_GET['Sirala']=='StokKodu'){
    if(isset($_GET['Yon']))
    { $query_rsUrun.="ORDER BY urun.StokKodu DESC ";}
    else{$query_rsUrun.="ORDER BY urun.StokKodu ASC ";}
}
}else{
    $query_rsUrun.="ORDER BY urun.UrunID DESC ";
}
$rsUrun = mysql_query($query_rsUrun);
$row_rsUrun = mysql_fetch_object($rsUrun);
$num_row_rsUrun = mysql_num_rows($rsUrun);

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
    <title>Ürünler</title>
    <script src="../../includes/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function(){
         //css özellikleri even-odd
         $("#UrunListe tr.listeVeri:even").addClass("evenTR");
         $("#UrunListe tr.listeVeri:odd").addClass("oddTR");
         //saturun üzerine gelince highlight effect 
         $("#UrunListe tr.listeVeri").hover(
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
        #UrunListe tr th{
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
    <h1>Ürün Listesi</h1>
    <p><a href="ekle.php">Ürün Ekle</a></p>
    <?php
    if(isset($_GET['KategoriID']))
{
        echo "<p><a href='index.php'>Tüm Ürünler</a></p>";
   }
    echo "<p><strong>Ürün Sayısı : $num_row_rsUrun</strong></p>";
    ?>
    <table id="UrunListe">
        <tr>
            <th>Resim</th>
            <th><a href="index.php?<?php if(isset($_GET['KategoriID']))
            {
                $kategoriID = getValues($_GET['KategoriID']);
                echo "KategoriID=$kategoriID&";
            }?>Sirala=UrunAdi"><img src="../../includes/img/azalt-k.png"/></a>
                    Ürün Adı
               <a href="index.php?<?php if(isset($_GET['KategoriID']))
            {
                $kategoriID = getValues($_GET['KategoriID']);
                echo "KategoriID=$kategoriID&";
            }?>Sirala=UrunAdi&Yon=DESC"><img src="../../includes/img/artir-k.png"/></a>     
            </th>
            <th>
                    <a href="index.php?<?php if(isset($_GET['KategoriID']))
            {
                $kategoriID = getValues($_GET['KategoriID']);
                echo "KategoriID=$kategoriID&";
            }?>Sirala=StokKodu"><img src="../../includes/img/azalt-k.png"/></a>
                   Stok Kodu
               <a href="index.php?<?php if(isset($_GET['KategoriID']))
            {
                $kategoriID = getValues($_GET['KategoriID']);
                echo "KategoriID=$kategoriID&";
            }?>Sirala=StokKodu&Yon=DESC"><img src="../../includes/img/artir-k.png"/></a>     
          
            
            </th>
            <th>Kategori</th>
            <th>Ekleme Tarihi</th>
            <th>Düzenle</th>
        </tr>
        <?php do{?>
        <tr class="listeVeri">
            <td><img src="../../uploads/urun/<?= $row_rsUrun->UrunResim;?>" width="50" /></td>
            <td><?= $row_rsUrun->UrunAdi;?></td>
            <td><?= $row_rsUrun->StokKodu;?></td>
            <td><a href="index.php?KategoriID=<?= $row_rsUrun->KategoriID;?>"><?= $row_rsUrun->Kategori;?></a></td>
            <td><?= date("d/m/Y H:i:s", strtotime($row_rsUrun->EklemeTarih));?></td>
            <td><a href="duzenle.php?UrunID=<?= $row_rsUrun->UrunID ;?>">Düzenle </a>
                <a href="sil.php?UrunID=<?= $row_rsUrun->UrunID;?>">Sil</a></td>
        </tr>
        <?php }while($row_rsUrun = mysql_fetch_object($rsUrun));?>
    </table>
</body>
</html>
