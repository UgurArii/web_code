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
$alan = 'Ekle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}

if(modulAktifmi('urun')==0){
    header("Location:../index.php?Hata=PasifModul");
}
//kategori kayıt seti
$query_rsKategori = "SELECT * FROM kategori";
$rsKategori = mysql_query($query_rsKategori);
$row_rsKategori = mysql_fetch_object($rsKategori);

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);

if(isset($_POST['urunEkleSubmit']))
{
    //form değerlerinin alınması
    $uyeID = $_SESSION['Uye']['UyeID'];
    $kategoriID = postValues($_POST['KategoriID']);
    $turID = postValues($_POST['TurID']);
    $stokKodu = postValues($_POST['StokKodu']);
    $urunAdi = postValues($_POST['UrunAdi']);
    $urunResim = postValues($_FILES['UrunResim']['name']);
    $dataTime = date("Y-m-d H:i:s",  time());
    $uyeIP = $_SERVER['REMOTE_ADDR'];
    if(isset($_POST['GosterimTurID'])){
        $gosterimTurID = 1;
    }else {
        $gosterimTurID = 0;
    }
    
    //query oluşturma
    $query_urunEkle = "INSERT INTO urun
    (KategoriID, StokKodu, UrunAdi, TurID, GosterimTurID, UrunResim, EklemeTarih, UyeID, UyeIP)
    VALUES
    ('$kategoriID','$stokKodu','$urunAdi','$turID','$gosterimTurID','$urunResim','$dataTime','$uyeID', '$uyeIP')
    ";
    
    $sonuc = mysql_query($query_urunEkle);
    
    if($sonuc){
        
        if(!empty($urunResim)){
        $filename = $_FILES['UrunResim']['tmp_name'];
        $destination = "../../uploads/urun/".$urunResim;
        $sonucResimYukleme = move_uploaded_file($filename, $destination);
        if($sonucResimYukleme){
            header("Location:index.php");
            exit();
        }else{
            header("Location:ekle.php?Hata=ResimYuklenemedi");
            exit();
            
        }
        }else{
        header("Location:index.php?Islem=UrunEkle&Resim=Secilmedi");
        exit();
        }
    }
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Ekle</title>
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
    <h1>Ürün Ekle</h1>
    <?php
    
    ?>
    <form action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Kategori, Tür ve Gösterim Seçimi</legend>
        <select id="KategoriID" name="KategoriID">
            <option value="0" disabled >Lütfen Bir Kategori Seçiniz</option>
            <?php do {?>
            <option value="<?= $row_rsKategori->KategoriID ;?>"><?= $row_rsKategori->Kategori;?></option>
            <?php }while($row_rsKategori=  mysql_fetch_object($rsKategori));?>
        </select>
            <label for="TurID">Ürün Türü</label> 
            <input type="radio" id="TurID" name="TurID" value="1" checked/>Mamül
            <input type="radio" id="TurID" name="TurID" value="0"/>Hammadde
            <label for="GosterimTuru">Herkes Görebilir mi?</label>
            <input type="checkbox" id="GosterimTuruID" name="GosterimTuruID" value="1" checked/>
        </fieldset>
        <fieldset>
            <legend>Ürün Bilgileri</legend>
        <label for="StokKodu">Stok Kodu</label>
        <input type="text" id="StokKodu" name="StokKodu"/>
        <label for="UrunAdi">Ürün Adı</label>
        <input type="text" id="UrunAdi" name="UrunAdi"/>
        <label for="UrunResim">Ürün Resim</label>
        <input type="file" id="UrunResim" name="UrunResim"/>
        <br/>
        <input type="submit" name="urunEkleSubmit" value="Ürün Ekle"/>
        </fieldset>
    </form>
</body>
</html>
