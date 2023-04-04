<?php 
require_once '../../_inc/connection.php';
require_once '../../_inc/genel/functions.php';
require_once '../_inc/resim/functions.php';
require_once '../_inc/urun/functions.php';
require_once '../_inc/uyelik/functions.php';
$yetki = yetkiVarmi($_SESSION['UyeID']);

if($yetki>1){
    header("Location:../../uye-giris.php?Hata=YetkisizKullanici");
}
$urunID = $_GET['UrunID'];

//resimler için kayıt setinin oluşturulması
$query_rsUrunResim = "SELECT * FROM urun_resim WHERE UrunID='$urunID'";
$rsUrunResim = mysql_query($query_rsUrunResim);
$row_rsUrunResim = mysql_fetch_object($rsUrunResim);
$num_row_rsUrunResim = mysql_num_rows($rsUrunResim);

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
    
     <script src="../../_inc/js/highslide/highslide-with-gallery.js" type="text/javascript"></script>
    <link href="../../_inc/js/highslide/highslide.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript">
    hs.graphicsDir = "../../_inc/js/highslide/graphics/";
    hs.align = 'center';
    hs.transitions = ['expand','crossfade'];
    hs.wrapperClassName = 'draggable-borderless floating-caption';
    hs.fadeInOut = true;
    hs.dimingOpacity .75;
    
    if(hs.addSlideshow) hs.addSlideshow({
        interval :5000,
        repeat : false,
        useControls: true,
        fixedControls: 'fit',
        overlayOptions:{
            opacity: .6,
            position:'button center',
            hideOnMouseOut:true
        }
        
    });
    //hs.minWidth = 1180;
    </script>
    <script type="text/javascript">


$(function() {
$("tr.urunResim:even").addClass("ciftSatir");
$("tr.urunResim:odd").addClass("tekSatir");

$(" tr.urunResim").hover(
    function(){
        $(this).toggleClass("uzerindeyken");
    }
    ,
    function (){
        $(this).toggleClass("uzerindeyken");
    }
);

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
     <?php
    // put your code here
    ?>
    <h1>Ürün Resimleri</h1>
    <p><strong>Ürün Adı: <?php echo urunAdiBul($urunID);?></strong></p>
    
    <?php if($num_row_rsUrunResim>0):?>
    <p>Bu ürüne ait toplam resim sayısı :<?= $num_row_rsUrunResim; ?></p>
    
    <table id="dinamikListe">
        <tr>
            <th>Resim Thumb</th>
            <th>Görüntüleme</th>
            <th>Aktif</th>
            <th>IP</th>
            <th>Üye</th>
            <th>Tarih</th>
            <th>Düzenle</th>
            
        </tr>
        <?php do{ ?>
        <tr class="urunResim">
            <td><a href="../../_uploads/resim/urun-resim/<?= $row_rsUrunResim->Resim; ?>"
                   class="highslide" onclick="return hs.expand(this)">
                    <img src="../../_uploads/resim/urun-resim/thumb/<?= $row_rsUrunResim->ResimThumb; ?>" width="100"/></a></td>
        <td><?= $row_rsUrunResim->Goruntuleme;?></td>        
        <td>
           <?php if($row_rsUrunResim->Aktif==1):?>
            <a href="aktif.php?Islem==Pasiflestir&ResimID=<?= $row_rsUrunResim->ResimID;?>&UrunID=<?= $row_rsUrunResim->UrunID;?>"> <img src="../../img/aktif-icon.png" alt="" width="25"/></a>
                         <?php else:?>
              <a href="aktif.php?Islem==Aktiflestir&ResimID=<?= $row_rsUrunResim->ResimID;?>&UrunID=<?= $row_rsUrunResim->UrunID;?>"> <img src="../../img/pasif-icon.png" alt="" width="25"/></a>
          
                         <?php endif;?>
        </td>    
        <td><?= $row_rsUrunResim->ResimIP;?></td>
        <td>
            <?= uyeKullaniciBul($row_rsUrunResim->UyeID);?>
        </td>
        <td>
        <?= date("d/m/Y H:s:i",  strtotime($row_rsUrunResim->ResimTarih));?>
        </td>
        <td>
            Düzenle |
            Sil</td>
        </tr>
        <?php }while($row_rsUrunResim = mysql_fetch_object($rsUrunResim));?>
    </table>
    <?php else:?>
    <p>Bu ürüne ait resim bulunmamaktadır.</p>
         <?php endif;?>
</section>
         <?php require '../_inc/footer.php';?>   

</body> 
</html>
