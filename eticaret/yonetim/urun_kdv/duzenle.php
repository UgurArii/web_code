<?php
//mysql sunucusuna bağlanma
require_once '../../_inc/connection.php';

$kdvID = mysql_real_escape_string($_GET['KdvID']);

//Kdv Kayıt Seti
$query_Kdv = "SELECT * FROM urun_kdv Where KdvID = '$kdvID'";
$rsKdv = mysql_query($query_Kdv);
$row_rsKdv = mysql_fetch_object($rsKdv);
$num_row_rsKdv = mysql_num_rows($rsKdv);

//form gönderildiğinde
if(isset($_POST['kdvDuzenleSubmit'])){
    echo "form gönderildi";
    
    //forma gelen değerlerin alınması
    
    $kdvTip = mysql_real_escape_string($_POST['KdvTip']);
    $kdv = mysql_real_escape_string($_POST['Kdv']);
    
    $query_Duzenle = "UPDATE urun_kdv SET KdvTip ='$kdvTip', Kdv = '$kdv' WHERE KdvID = '$kdvID'";
    
    $sonuc = mysql_query($query_Duzenle);
    
    //başarılı sonuç oluştuğunda
    if($sonuc){
        header("Location:index.php");
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>KDV Tipi Düzenle </title>
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
     <form action="<?php echo $_SERVER['PHP_SELF'] ."?KdvID=" .$kdvID;?>" method="post">
        <fieldset>
            <legend>KDV Bilgileri</legend>
            <label for="KdvTip">KDV Tipi</label>
            <input type="text" name="KdvTip" id="KdvTip" value="<?= $row_rsKdv->KdvTip;?>" />
            <label for="Kdv">KDV</label>
            <input type="text" name="Kdv" id="Kdv" value="<?= $row_rsKdv->Kdv;?>" />
            <br />
            <input type="submit" name="kdvDuzenleSubmit" value="Değişikliği Kaydet" />
        </fieldset>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
