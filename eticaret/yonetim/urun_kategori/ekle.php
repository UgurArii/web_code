<?php
require_once '../../_inc/connection.php';

//parent değer kontrolü
if(isset($_GET['KategoriID'])){
    $parentID = mysql_real_escape_string($_GET['KategoriID']);
    
    $query_rsKategori = "SELECT * FROM urun_kategori WHERE KategoriID = '$kategoriID'";
    $rsKategori = mysql_query($query_rsKategori);
    $row_rsKategori = mysql_fetch_object($rsKategori);
}else{
    $parentID = 0;
}

//forma gönderilirse
if(isset($_POST['kategoriResimEkle'])){
    echo "form gönderildi";
    
       //formdan genel değerlerin alınması
    if(!empty($_POST['Kategori'])){
        $kategori = mysql_real_escape_string($_POST['Kategori']);
        $kategoriResim = mysql_real_escape_string($_FILES['KategoriResim']['name']);
        
        //veritabanına yazdırma
        $query_KategoriEkle = "INSERT INTO urun_kategori (Kategori,ParentID,KategoriResim) VALUES('$kategori','$parentID','$kategoriResim')";
        echo $query_KategoriEkle;
        
        $sonuc = mysql_query($query_KategoriEkle);
        if($sonuc){
            
            //resim yüklenir
            $destination = "../../_uploads/resim/urun-kategori/".$kategoriResim;
            $sonuc = move_uploaded_file($_FILES['KategoriResim']['tmp_name'], $destination);
            
            //resim başarıyla yüklendiyse
            if($sonuc){
                //kategori index sayfasının yenilenmesi
                header("Location:index.php");
            }
        }
    }else{
        echo "kategori ismini boş bırakmayınız";
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
       <h1>Kategori Ekle</h1>
    <?php
    if($parentID!=0){
        echo "Kategorinin Parenti : $row_rsKategori->KategoriID";
    }else{
        
    }
    
    ?>
    
    <form method="post" action="<?= $_SERVER['PHP_SELF'];?>?KategoriID=<?= $parentID; ?>" enctype="multipart/form-data">
        <fieldset>
        <legend>Kategori Bilgiler</legend>
        <label for="Kategori">Kategori Adı</label>
        <input type="text" name="Kategori" id="Kategori"/>
        <label for="KategoriResim">Kategori Resim</label>
        <input type="file" name="KategoriResim" id="KategoriResim"/>
        <br/>
        <br/>
        <input type="submit" name="kategoriResimEkle" id="kategoriResimEkle"/>
    </fieldset>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
