<?php 
require_once '../../_inc/connection.php';
require_once '../_inc/functions.php';

//Kdv Kayıt Seti
$query_rsKdv = "SELECT * FROM urun_kdv";
$rsKdv = mysql_query($query_rsKdv);
$row_rsKdv = mysql_fetch_object($rsKdv);

//kategori kayıt seti
$query_rsKategori = "SELECT * FROM urun_kategori";
$rsKategori = mysql_query($query_rsKategori);
$row_rsKategori = mysql_fetch_object($rsKategori);

//ürün id değerinin alınması
$urunID = mysql_real_escape_string($_GET['UrunID']);

//echo "Gelen Ürün ID  : $urunID";

//urun kayıt seti
$query_rsUrun = "SELECT * FROM urun WHERE UrunID = '$urunID'";
$rsUrun = mysql_query($query_rsUrun);
$row_rsUrun = mysql_fetch_object($rsUrun);

/*  echo "<pre>";*/
//print_r($row_rsUrun);

//form gönderildi
if(isset($_POST['urunDuzenleSubmit'])){
    echo "form gönderildi";
    
    //formdan gelen verilerini alacağız
 /*   echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
      echo "<pre>";
    */
    
    $kdvID = mysql_real_escape_string($_POST['KdvID']);
    $kategoriID = mysql_real_escape_string($_POST['KategoriID']);
    
    $urunAdi = mysql_real_escape_string($_POST['UrunAdi']);
    $urunFiyat = mysql_real_escape_string($_POST['UrunFiyat']);
    $indirimliFiyat = mysql_real_escape_string($_POST['IndirimliFiyat']);
    
    if(isset($_POST['UrunAktif'])) {
        $urunAktif = 1;
    }else{
        $urunAktif = 0;
    }

        if(isset($_POST['Indirim'])) {
        $indirim = 1;
    }else{
        $indirim = 0;
    }
    
    //echo "ürün aktif değeri $urunAktif";
    
    $urunResim =  mysql_real_escape_string($_FILES['UrunResim']['name']);
    
    if(empty($urunResim)){
        $urunResim = $row_rsUrun->UrunResim;
        
    }
    
    // echo "ürün resim değeri $urunResim";
    
    //boş alan izin verilmemesi
    if(!empty($urunAdi) && !empty($urunFiyat)){
        //veritabanında verilerin güncellemesi
        
        $query_UrunDuzenle ="UPDATE urun SET KategoriId = '$kategoriID', KdvID = '$kdvID', UrunAdi='$urunAdi', UrunFiyat='$urunFiyat', UrunResim= '$urunResim', UrunAktif='$urunAktif', Indirim='$indirim', IndirimliFiyat='$indirimliFiyat' WHERE UrunID=$urunID ";
       // echo "güncellem sorgusu $query_UrunDuzenle";
        $sonuc = mysql_query($query_UrunDuzenle);
        
        if($sonuc){
            //resim yükleme yapılması
            if($row_rsUrun->UrunResim!=$urunResim){
               $filename = $_FILES['UrunResim']['tmp_name'];
               $destination = "../../_uploads/resim/urun/$urunResim";
               
               move_uploaded_file($filename, $destination);
                 header("Location:index.php");
            }
            else{
                header("Location:index.php");
            }
        }
         }else{
        header("Location:index.php?UrunID=$urunID&Hata=AlanBos");
    }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Düzenle</title>
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
     <h1>Ürün Düzenle</h1>
     <?php if(urunProfilIDBul($urunID)!=0) :?>
     <p><a href="../urun_profil/duzenle.php?UrunProfilID=<?= urunProfilIDBul($urunID);?>">Ürün Profil Düzenle</a></p>
     <?php else:?>
     <p class="yesilKutu">Henüz bu ürün için profil bulunmamaktadır.<br/>
         <a href="../urun_profil/ekle.php?UrunID=<?= $urunID;?>">Ürün Profil Oluştur</a></p>
     <?php     endif;?>
    <?php
   if(isset($_GET['Hata'])){
       echo "<p>Ürün Adı ve Ürün Fiyatı Boş Bırakılamaz</p>";
   }
    ?>
    
    <form method="post" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ;?>?UrunID=<?= $urunID ?>">
        <fieldset>
            <legend>Kategori ve KDV Bilgileri</legend>
            <label for="KategoriID">Kategori</label>
            <select name="KategoriID" id="KategoriID">
                <?php do {?>
                <option value ="<?= $row_rsKategori->KategoriID ;?>"<?php if($row_rsKategori->KategoriID==$row_rsUrun->KategoriID) :?> selected="selected" <?php endif;?> > <?= $row_rsKategori->Kategori;?></option>
                <?php } while($row_rsKategori = mysql_fetch_object($rsKategori)); ?>
            </select>
            <label for="KdvID">Kdv Değeri</label>
            <select name="KdvID" id="KdvID">
                <?php do{ ?>
                <option value="<?= $row_rsKdv->KdvID;?>" <?php if($row_rsKdv->KdvID==$row_rsUrun->KdvID) {echo ' selected="selected "';}?>><?= $row_rsKdv->KdvTip ;?></option> 
                <?php } while($row_rsKdv = mysql_fetch_object($rsKdv)); ?>
            </select>
        </fieldset>
        
        <fieldset>
            <legend>Ürün Temel Bilgileri</legend>
            <label for="UrunAdi">Ürün Adı</label>
            <input type="text" name="UrunAdi" id="UrunAdi" value="<?= $row_rsUrun->UrunAdi;?>" size="50"/>
            <label for="UrunFiyat">Ürün Fiyat</label>
            <input type="text" name="UrunFiyat" id="UrunFiyat" value="<?= $row_rsUrun->UrunFiyat;?>" />
            <p>
                <img src="../../_uploads/resim/urun/<?= $row_rsUrun->UrunResim ;?>" />
            </p>
            <label for="UrunResim">Yeni Resim</label>
            <input type="file" name="UrunResim" id="UrunResim" />
            <label for="UrunAktif">Ürün Aktif Mi?</label>
            <input type="checkbox" name="UrunAktif" id="UrunAktif" value="<?= $row_rsUrun->UrunAktif;?>"<?php if ($row_rsUrun->UrunAktif == 1) echo 'checked'; ?> />
            <br/>
            
           
        </fieldset>
        <fieldset>
            <legend>İndirimli Fiyat</legend>
            <label for="IndirimliFiyat">İndirimli Fiyat</label>
            <input  type="text" name="IndirimliFiyat" id="IndirimliFiyat" value="<?= $row_rsUrun->IndirimliFiyat;?>"/>
            
            <label for="Indirim">İndirim Var Mı?</label>
            <input type="checkbox" name="Indirim" id="Indirim" <?php if($row_rsUrun->Indirim==1){echo "cheched";} ?>/>
        </fieldset>
         <input type="submit" name="urunDuzenleSubmit" value="Değişiklikleri Kaydet"/>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
