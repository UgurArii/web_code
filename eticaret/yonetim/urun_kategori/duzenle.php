<?php 
require_once '../../_inc/connection.php';

$kategoriID = mysql_real_escape_string($_GET['KategoriID']);

//düzenlenecek olan kayıt seti
$query_rsKategori = "SELECT * FROM urun_kategori WHERE KategoriID = '$kategoriID'";

//echo $query_rsKategori
$rsKategori  =  mysql_query($query_rsKategori);
$row_rsKategori = mysql_fetch_object($rsKategori);

//parent kayıt seti
$query_rsParent = "SELECT * FROM urun_kategori";
$rsParent = mysql_query($query_rsParent);
$row_rsParent = mysql_fetch_object($rsParent);

//form gönderildiğinde

if(isset($_POST['kategoriDuzenleSubmit'])){
    
    //echo "form gönderildi";
    
    $kategori = mysql_real_escape_string($_POST['Kategori']);
    $parentID = mysql_real_escape_string($_POST['ParentID']);
    $kategoriResim = mysql_real_escape_string($_FILES['KategoriResim']['name']);
    
    if(!empty($kategori)){
        
       // echo "her şey yolunda";
        
        if(!empty($kategoriResim)){
            $kategoriResim = $row_rsKategori->KategoriResim;
        }
        // echo "veri tabanı güncellenecek resim adı : $kategoriResim";
        
        //veritabanı sorgusunun oluşturulması
        $query_KategoriDuzenle = "UPDATE urun_kategori SET Kategori ='$kategori', ParentID='$parentID', KategoriResim='$kategoriResim' WHERE KategoriID='$kategoriID'";
        $sonuc = mysql_query($query_KategoriDuzenle);
        
        if($sonuc){
            
            //eğer farklı bir resim varsa yüklenecek
            if($row_rsKategori->KategoriResim!=$kategoriResim){
                $filename = $_FILES['KategoriResim']['tmp_name'];
                $destination = "../../_uploads/resim/urun-kategori/$kategoriResim";
                move_uploaded_file($filename, $destination);
                
                header("Location:index.php");
            }
        }
         
    }else{
        header("Location:duzenle.php?KategoriID=$kategoriID&Hata=AlanBos");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title> </title>
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
            <table>
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
        <?php
   if(isset($_GET['Hata'])){
       echo "<p>Lütfen Kategori Alanını Boş Bırakmayınız</p>";
   }
    ?>
    
    <form action ="<?= $_SERVER['PHP_SELF'];?>?KategoriID=<?= $kategoriID;?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Kategori Bilgileri</legend>
            <label for="ParentID">Parent Kategorisi</label>
            <select name="ParentID" id="ParentID">
                <?php do{ ?>
                <?php if($row_rsKategori->ParentID==0){ ?>
                <option value="0" selected="selected">Parent Kategorisi Yok</option>
                <?php }else { ?>
                <option value="<?= $row_rsParent->KategoriID?>" <?php if($row_rsParent->KategoriID==$row_rsKategori->ParentID) echo'selected="selected";' ?>><?= $row_rsParent->Kategori?></option>
                <?php }?>
                  <?php } while($row_rsParent = mysql_fetch_object($rsParent));?>
                
            </select>
            <label for="Kategori">Kategori </label>
            <input type="text" name="Kategori" id="Kategori" value="<?= $row_rsKategori->Kategori;?>" />
            <p>Şu Anki Resim</p>
            <img src="../../_uploads/resim/urun-kategori/<?= $row_rsKategori->KategoriResim;?>" />
            <label for="KategoriResim">Kategori Resim</label>
            <input type="file" name="KategoriResim" id="KategoriResim"/>
            <br/>
            <input type="submit" name="KategoriDuzenleSubmit" value="DeğişikliğiKaydet" />
        </fieldset>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
