<?php
//mysql sunucusuna bağlanma
require_once '../../_inc/connection.php';

//kdv bilgilerinin alınacağı kayıt seti
$query_Kdv = "SELECT * FROM urun_kdv";
$rsKdv = mysql_query($query_Kdv);
$row_rsKdv = mysql_fetch_object($rsKdv);
$num_row_rsKdv = mysql_num_rows($rsKdv);

//kategori billgilerinin alınacağı kayıt seti
$query_UrunKategori = "SELECT * FROM urun_kategori";
$rsUrunKategori = mysql_query($query_UrunKategori);
$row_rsUrunKategori = mysql_fetch_object($rsUrunKategori);
$num_row_rsUrunKategori = mysql_num_rows($rsUrunKategori);

//form gönderildiğinde çalışacak
if(isset($_POST['urunEkleSubmit'])){
    /*
    echo "form gönderildi";
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
    */
    //1.form verilerinin alınması
    $kategoriID = mysql_real_escape_string($_POST['KategoriID']);
    $kdvID = mysql_real_escape_string($_POST['KdvID']);
    $urunAdi = mysql_real_escape_string($_POST['UrunAdi']);
    $urunFiyat = mysql_real_escape_string($_POST['UrunFiyat']);
    $indirimliFiyat = mysql_real_escape_string($_POST['IndirimliFiyat']);
    
    //ürün aktiflik değerinin alınması
    if($_POST['UrunAktif']=='on'){
        $urunAktif = 1;
    }else{
        $urunAktif=0;
    }
    
        //ürün indirim aktiflik değerinin alınması
    if($_POST['Indirim']=='on'){
        $indirim= 1;
    }else{
        $indirim=0;
    }
    
    //resim adının alınması
    $urunResim = mysql_real_escape_string($_FILES['UrunResim']['name']);
        
    //2.form verileri veritabanına girilecek
    $query_UrunEkle = "
        INSERT INTO urun (KategoriID,KdvID,UrunAdi,UrunFiyat,UrunAktif,UrunResim,IndirimliFiyat,Indirim)
            VALUES 
            ('$kategoriID','$kdvID','$urunAdi','$urunFiyat','$urunAktif','$urunResim','$indirimliFiyat','$indirim')";
    
    $sonuc = mysql_query($query_UrunEkle);
    
    
    //3.resim yüklenecek
    
    //veritabanına veri girildiyse resmi yüklenecek
    if($sonuc){
        $filename = $_FILES['UrunResim']['tmp_name'];
        $destination = "../../_uploads/resim/urun/"."$urunResim";
        move_uploaded_file($filename, $destination);
        
            //4.ürün index sayfasına yönlentirecek
        header("Location:index.php");
    }

}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Ekle</title>
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
//    echo "KDV çeşidi sayısı : " .$num_row_rsKdv;
//    echo "<br/>";
//    echo "Ürün Kategori sayısı: " .$num_row_rsUrunKategori; 
    
    ?>
    <h1>Ürün Ekle</h1>
    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Kategori ve KDV Bilgisi</legend>
            
              <label for="KategoriID">Ürün Kategorisi</label>
            <select name="KategoriID" id="KategoriID">
                <?php do{ ?>
                     <option value="<?= $row_rsUrunKategori->KategoriID;?>">
                    <?= $row_rsUrunKategori->Kategori; ?>
                     </option>
                <?php  }while ($row_rsUrunKategori=  mysql_fetch_object($rsUrunKategori)); ?>
            </select>
                       
            <label for="KdvID">KDV Tipi</label>
            <select name="KdvID" id="KdvID">
                    <?php do{ ?>
                     <option value="<?= $row_rsKdv->KdvID; ?>">
                        <?= $row_rsKdv->KdvTip; ?>
                     </option>
                <?php  }while ($row_rsKdv=  mysql_fetch_object($rsKdv)); ?>
                
            </select>
        </fieldset>
        <fieldset>
            <legend>Ürün Bilgisi</legend>
            <label for="UrunAdi">Ürün Adı</label>
            <input type="text" name="UrunAdi" id="UrunAdi" />
            <label for="UrunFiyat">Ürün Fiyat</label>
            <input type="text" name="UrunFiyat" id="UrunFiyat" />
            <label for="UrunAktif">Ürün Yayınlansın mı?</label>
            <input type="checkbox" name="UrunAktif" id="UrunAktif" />
            <label for="UrunResim">Ürün Resim</label>
            <input type="file" name="UrunResim" id="UrunResim" />
        </fieldset>
        
        <fieldset>
            <legend>İndirim Bilgisi</legend>
            <label for="IndirimliFiyat">İndirimli Fiyat</label>
            <input type="text" name="IndirimliFiyat" id="IndirimliFiyat"/>
            
            <label for="Indirim">İndirim Var Mı?</label>
            <input type="checkbox" name="Indirim" id="Indirim"/>
        </fieldset>
        <input type="submit" name="urunEkleSubmit" value="Ürün Ekle" />
    </form>

</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
