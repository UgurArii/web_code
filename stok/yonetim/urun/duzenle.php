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
$alan = 'Duzenle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('urun')==0){
    header("Location:../index.php?Hata=PasifModul");
}

$urunID = getValues($_GET['UrunID']);

//ürün kayıt seti
$query_rsUrun = "SELECT * FROM urun WHERE UrunID='$urunID'";
$rsUrun = mysql_query($query_rsUrun);
$row_rsUrun = mysql_fetch_object($rsUrun);

//kategori kayıt seti
$query_rsKategori = "SELECT * FROM kategori";
$rsKategori = mysql_query($query_rsKategori);
$row_rsKategori = mysql_fetch_object($rsKategori);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

if(isset($_POST['urunDuzenleSubmit'])){
    

$kategoriID = postValues($_POST['KategoriID']);
$turID = postValues($_POST['TurID']);
$gosterimTurID = postValues($_POST['GosterimTurID']);
$stokKodu = postValues($_POST['StokKodu']);
$urunAdi = postValues($_POST['UrunAdi']);
$urunResim = postValues($_FILES['UrunResim']['name']);
$urunTmpName = postValues($_FILES['UrunResim']['tmp_name']);
$uyeID = $_SESSION['Uye']['UyeID'];
//resim boş mu ona göre resim alanı 

if(empty($urunResim))
{
    $urunResim = $row_rsUrun->UrunResim;
    $yeniResim = false;
}else{
    $yeniResim = true;
}

//ürün düzenle query oluşturulması
$query_UrunDuzenle = "UPDATE urun SET
    KategoriID = '$kategoriID',
    StokKodu = '$stokKodu',
    UrunAdi = '$urunAdi',
    TurID = '$turID',
    GosterimID = '$gosterimTurID',
    UrunResim = '$urunResim',
    UyeID = '$uyeID'   
    WHERE UrunID = '$urunID'";
$sonuc = mysql_query($query_UrunDuzenle);

//eğer yeni resim varsa eski resim kaldırılacak
if($sonuc){
    if($yeniResim){
        $filename = $urunTmpName;
        $destination = "../../uploads/urun/".$urunResim;
        $resimYuklemeSonuc = move_uploaded_file($filename, $destination);
        if($resimYuklemeSonuc)
        {
            if(!empty($row_rsUrun->UrunResim)){
                $silinecekResim = "../../uploads/urun/".$row_rsUrun->UrunResim;
                
                $sonuc = unlink($silinecekResim);
                header("Location:index.php?Islem=Duzenle&ResimYuklemeveSilme=Basarili");
                
            }
        }
    }else{
        
        header("Location:index.php");
    }
}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Düzenle</title>
      <style>
        label{
            display: block;
            color: #769dc5;
            font-weight: bold;
            margin: 10px 0;
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
    <h1>Ürün Düzenle</h1>
    <?php
    // put your code here
    ?>
    <form action="<?= $_SERVER['PHP_SELF'];?>/UrunID=<?= $urunID;?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Kategori ve Gösterim Bilgileri</legend>
            <select id="KategoriID" name="KategoriID">
                <?php do{?>
                <option value="<?= $row_rsKategori->KategoriID;?>"<?php if($row_rsKategori->KategoriID==$row_rsUrun->KategoriID) echo "selected";?>><?= $row_rsKategori->Kategori;?></option>
                <?php }while($row_rsKategori = mysql_fetch_object($rsKategori));?>
                 </select>
                <label for="TurID">Ürün Türü</label> 
            <input type="radio" id="TurID" name="TurID" value="1" <?php if($row_rsUrun->TurID==1) echo"checked";?>/>Mamül
            <input type="radio" id="TurID" name="TurID" value="0" <?php if($row_rsUrun->TurID==0) echo"checked";?>/>Hammadde
            <label for="GosterimTuru">Herkes Görebilir mi?</label>
            <input type="checkbox" id="GosterimTurID" name="GosterimTurID" value="1" <?php if($row_rsUrun->GosterimTurID==1) echo"checked";?>/>
       
           
        </fieldset>   
        <fieldset>
            <legend>Ürün Bilgileri</legend>
            <label for="StokKodu">Stok Kodu</label> 
            <input type="text" id="StokKodu" name="StokKodu" value="<?= $row_rsUrun->StokKodu;?>"/>
            
            <label for="UrunAdi">Ürün Adı</label>
            <input type="text" id="UrunAdi" name="UrunAdi" value="<?= $row_rsUrun->UrunAdi;?>" />
            <p><img src="../../uploads/urun/<?= $row_rsUrun->UrunResim;?>" height="180"</p>
            <label for="UrunResim">Yeni Ürün Resmi</label>
            <input type="file" id="UrunResim" name="UrunResim"/>
        </fieldset>
        <input type="submit" name="urunDuzenleSubmit" value="Değişiklikleri Kaydet"/>
    </form>
</body>
</html>
