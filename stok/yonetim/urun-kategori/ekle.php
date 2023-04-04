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
$alan = 'Ekle';
if(!yetkiVarmi($_SESSION['Uye']['SeviyeID'],4, $uyeID, $modulID,$alan)){
   // header("Location:../index.php?Hata=YetkisizGiris");
}
if(modulAktifmi('urun-kategori')==0){
    header("Location:../index.php?Hata=PasifModul");
}

$uyeSeviyeID = $_SESSION['Uye']['UyeID'];
$query_rsModul = "SELECT ModulAdi, ModulDizin, ModulResim FROM modul WHERE ModulAktif=1 AND ModulSeviye >= $uyeSeviyeID AND ModulID!=1 AND ModulID!=17 AND ModulID IN(SELECT ModulID FROM modul_uye WHERE UyeID='$uyeID') ORDER BY ModulSira ASC";
$rsModul = mysql_query($query_rsModul);
$row_rsModul = mysql_fetch_object($rsModul);
$num_row_rsModul = mysql_num_rows($rsModul);
//eğer ParentID gelirse ParentId değeri alınacak yoksa ParentID sıfır gelecek
if(isset($_GET['ParentID']))
{
    $parentID = getValues($_GET['ParentID']);
    $parent = parentKategoriBul($parentID);
}else{
    $parentID = 0;
}


// eper submit yapılırsa
if(isset($_POST['urunKategoriEkleSubmit']))
{
//    echo "Form gönderildi";
//    exit();

    //form değerleri alınır
    $kategori = postValues($_POST['Kategori']);
    
    //resim değer $_FILES 
    if(!empty($_FILES['KategoriResim']['name'])){
    $kategoriResim = postValues($_FILES['KategoriResim']['name']);
    
   
    }else{
        $kategoriResim = "";
    }
    
    $query_rsKategoriVarmi = "SELECT Kategori FROM kategori WHERE Kategori='$kategori'";
    $rsKategoriVarmi = mysql_query($query_rsKategoriVarmi);
    $num_row_rsKategoriVarmi = mysql_num_rows($rsKategoriVarmi);
    
    echo "Kategoride kaç tane var ".$num_row_rsKategoriVarmi;
    if($num_row_rsKategoriVarmi!==0){
        header("Location:ekle.php?Hata=KategoriVar");
        exit();
    }
    
    
    //veritabanına verilerin girmek için
    
    //1.adım query adı verilen sorgu cümlesi oluşturulur
    
    $query_urunKategoriEkle = "INSERT INTO kategori
       (ParentID,Kategori,KategoriResim)
       VALUES
       ('$parentID','$kategori','$kategoriResim')
      ";
    
    //query çalıştırılır
    $sonuc = mysql_query($query_urunKategoriEkle);
    
    if($sonuc)
    {
//        echo "kategori tablosuna veriler başarıyla eklendi";
        
        $filename = $_FILES['KategoriResim']['tmp_name'];
        $destination = "../../uploads/urun-kategori/".$kategoriResim;
        $sonucResimYukleme = move_uploaded_file($filename, $destination);
        
        if($sonucResimYukleme){
        header("Location:index.php");
        }else{
            echo "Resim Yüklenmedi";
        }
    }
    
    
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Ekle | Stok Yönetim </title>
</head>
<body>
    <h1>Ürün Kategori Ekle</h1>
    <?php if(isset($parent)) echo "<p><strong>Parent Kategoriniz $parent</strong></p>";?>
    <form action="<?=$_SERVER['PHP_SELF'];?>?ParentID=<?= $parentID;?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Ürün Kategori Bilgileri</legend>
            <label for="Kategori">Kategori Adı</label>
            <input type="text" name="Kategori" id="Kategori" required="required"/>
            
            <label for="KategoriResim">Kategori Resim</label>
            <input type="file" name ="KategoriResim" id="KategoriResim"/>
            
            <input type="submit" name="urunKategoriEkleSubmit" value="Kategori Ekle"/>
        </fieldset>    
    </form>
</body>
</html>
