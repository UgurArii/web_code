<?php 
require_once '../../_inc/connection.php';

//harfID değeri alınır
$harfID = mysql_real_escape_string($_GET['HarfID']);

//ürün harf kayıt setinin alınması
$query_rsUrunHarf = "SELECT * FROM urun_harf WHERE HarfID = '$harfID'";
$rsUrunHarf = mysql_query($query_rsUrunHarf);
$row_rsUrunHarf = mysql_fetch_object($rsUrunHarf);

if(isset($_POST['urunHarfDuzenleSubmit'])){
    
    $harf = mysql_real_escape_string($_POST['Harf']);
    $harfSimge = $_FILES['HarfSimge']['name'];
    
    //resim var mı yok mu
    if(empty($harfSimge)){
        $harfSimge = $row_rsUrunHarf->HarfSimge;
    }
    $query_rsUrunHarfDuzenle = "UPDATE urun_harf SET Harf='$harf' AND HarfSimge='$harfSimge' WHERE HarfID= '$harfID'";
    $result = mysql_query($query_rsUrunHarfDuzenle);
    
    if($result){
        //eğer resim boş değilse
        if(!empty($_FILES['HarfSimge']['name'])){
            $filename = $_FILES['HarfSimge']['tmp_name'];
            $destination = "../../_uploads/resim/urun-harf/" . $_FILES['HarfSimge']['name'];
            move_uploaded_file($filename, $destination);
            
            header("Location:index.php?Islem=Duzenle");
            
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Harf Düzenle </title>
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
    <h1>Ürün Harf Düzenle</h1>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>?HarfID=<?php echo $harfID;?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Ürün Harf Düzenle</legend>
            <label for="Harf">Harf</label>
            <input type="text" name="Harf" id="Harf" value="<?=$row_rsUrunHarf->Harf; ?>" required/>
            <p><img src="../../_uploads/resim/urun-harf/<?= $row_rsUrunHarf->HarfSimge?>"/></p>
              <label for="HarfSimge">Yeni Resim</label>
            <input type="file" name="HarfSimge" id="HarfSimge" />
            <input type="submit" name="urunHarfDuzenleSubmit" value="Değişikleri Kaydet"/>
        </fieldset>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
