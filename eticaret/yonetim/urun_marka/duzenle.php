<?php 
require_once '../../_inc/connection.php';

//markaId alınması
$markaID = mysql_real_escape_string($_GET['MarkaID']);


//marka setinin oluşturulması
$query_rsUrunMarka = "SELECT * FROM urun_marka WHERE MarkaID='$markaID'";
$rsUrunMarka = mysql_query($query_rsUrunMarka);
$row_rsUrunMarka = mysql_fetch_object($rsUrunMarka);

//marka harf kayıt setinin oluşturulması
$query_rsUrunHarf = "SELECT * FROM urun_harf";
$rsUrunHarf = mysql_query($query_rsUrunHarf);
$row_rsUrunHarf = mysql_fetch_object($rsUrunHarf);

//form gönderildiğinde
if(isset($_POST['urunMarkaDuzenle'])){
//    echo "düzenle formu gönderildi";
//    echo "<pre>";
//    print_r($_POST);
//    print_r($_FILES);
//    echo "</pre>";
//    exit();
    
    //form verilerinin alınması
    $marka = mysql_real_escape_string($_POST['Marka']);
    $markaLogo = $_FILES['MarkaLogo']['name'];
    $harfID = mysql_real_escape_string($_POST['HarfID']);
    
    if(isset($_POST['Listeleme'])){
        $listeleme = 1;
    }else{
        $listeleme = 0;
    }
    //yeni resim gelme durumuna göre işlemler
    if(!empty($markaLogo)){
        //yeni logo gelmediyse
        $markaLogo = $row_rsUrunMarka->MarkaLogo;
    }else{
        //eski logo silinecek
        $filename= "../../_uploads/resim/urun-marka/".$row_rsUrunMarka->MarkaLogo;
        unlink($filename);
        
        //yeni logo yüklenecek
        $filename = $_FILES['MarkaLogo']['tmp_name'];
        $destination = "../../_uploads/resim/urun-marka/" . $markaLogo;
        move_uploaded_file($filename, $destination);
    }
    //form verilerine göre güncelleme yapılması
    $query_urunMarkaDuzenle = "UPDATE urun_marka SET Marka = '$marka', MarkaLogo = '$markaLogo', HarfID='$harfID', Listeleme='$listeleme' WHERE MarkaID = '$markaID'";
    $result = mysql_query($query_urunMarkaDuzenle);
    
    //index sayfasına yönlendirimesi
    if($result){
        header("Location:index.php");
        exit();
    }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title> <?= $row_rsUrunMarka->Marka;?>Ürün Marka Düzenle</title>
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
    <h1>Ürün Marka Düzenle</h1>
    <form action="<?= $_SERVER['PHP_SELF'];?>?MarkaID=<?= $markaID;?>" enctype="multipart/form-data" method="post" >
        <fieldset>
            <legend>Harf Bilgileri</legend>
            <label>Harf Bilgileri</label>
            <select name="HarfId" id="HarfID">
                <?php  do{ ?>
                <option value="<?= $row_rsUrunHarf->HarfID;?>"
                        <?php if($row_rsUrunHarf->HarfID==$row_rsUrunMarka->HarfID) echo "selected";?>
                        ><?= $row_rsUrunHarf->Harf;?></option>
                <?php }while($row_rsUrunHarf = mysql_fetch_object($rsUrunHarf));?>
            </select>
      
        <label for="Listeleme">Listelensin mi?</label>
        <input type="checkbox" name="Listeleme" id="Listeleme" <?php if($row_rsUrunMarka->Listeleme==1) echo "checked"; ?>/>
          </fieldset>
        <fieldset>
            <legend>Ürün Marka Bilgileri</legend>
            <label for="Marka">Ürün Markası</label>
            <input type="text" name="Marka" id="Marka" value="<?= $row_rsUrunMarka->Marka;?>"  required/>
            
            <p><strong>Şu anki Resim</strong></p>
            <p><img src="../../_uploads/resim/urun-marka/<?= $row_rsUrunMarka->MarkaLogo;?>" height="100"/></p>
            <label for="MarkaLogo">Marka Logo</label>
            <input type="file" name="MarkaLogo" id="MarkaLogo"/>
            <br>
            <input type="submit" name="urunMarkaDuzenle" value="Değişiklikleri Kaydet"/>
        </fieldset>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
