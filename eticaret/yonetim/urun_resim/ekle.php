<?php 
require_once '../../_inc/connection.php';
require_once '../../_inc/genel/functions.php';
require_once '../_inc/resim/functions.php';
require_once '../_inc/uyelik/functions.php';

$yetki = yetkiVarmi($_SESSION['UyeID']);

if($yetki>1){
    header("Location:../../uye-giris.php?Hata=YetkisizKullanici");
}
$urunID = $_GET['UrunID'];
$uyeID = $_SESSION['UyeID'];
$uyeIP = $_SERVER['REMOTE_ADDR'];
$aktif = 1;
if(isset($_POST['resimEkleSubmit'])){
    
    $resimDizisiSayisi = count($_FILES['Resim']['name']);
    for($i=0;$i<$resimDizisiSayisi;$i++){
        //resmin uzantısı bul
      
        $type = $_FILES['Resim']['type'][$i];
        $name = $_FILES['Resim']['name'][$i];
        $tmp_name = $_FILES['Resim']['tmp_name'][$i];
        $path = "../../uploads/resim/urun-resim/";
        $thumbPath = $path."thumb/";
        $resimThumb = resimThumbnailOlustur($tmp_name,$type,$thumPath);
        $resim = resimYukle($tmp_name, $type, $path);
        
        //resimlerin veritabanına girilmesi
        $query = "INSERT INTO urun_resim(UrunID, UyeID, Resim, ResimThumb, Aktif, ResimIP)";
        $query .= "VALUES ('$urunID', '$uyeID', '$resim', '$resimThumb','$aktif', '$uyeIP')";
        
        mysql_query($query);
    }
    header("Location:index.php?Islem=ResimEkle&UrunID=$urunID");
    exit();
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
     <?php require '../_inc/header.php';?>  
    </header>
    <nav>
    <?php require '../_inc/nav.php';?>   
    </nav>
<section>
    <form action="ekle.php?UrunID=<?=$urunID;?>" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Resim Seçimi</legend>
            <label for="Resim">Ürün Resim</label>
            <input type="file" name="Resim[]" id="Resim" multiple/>
            <input type="submit" name="resimEkleSubmit" value="Resim Ekle"/>
            
        </fieldset>
    </form>
</section>
         <?php require '../_inc/footer.php';?>   

</body>
</html>
