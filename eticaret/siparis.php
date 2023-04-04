<?php
require_once '_inc/connection.php';
require_once '_inc/sepet/functions.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';

//header search kategori kayıt setinin oluşturulması
$query_rsHeaderAramaKategori = "SELECT * FROM urun_kategori WHERE ParentID=0";
$rsHeaderAramaKategori = mysql_query($query_rsHeaderAramaKategori);
$row_rsHeaderAramaKategori = mysql_fetch_object($rsHeaderAramaKategori);

//sepet işlemleri
                $sepetDurum = sepetVarmi();
                
                if(isset($_GET['Islem']) && $_GET['Islem']=='SepeteEkle' && $sepetDurum==FALSE){
                    sepetOlustur();
                }
                

   if(isset($_SESSION['sepet']) && isset($_GET['Islem']) &&$_GET['Islem']=='SepeteEkle' && $_GET['UrunID']){
                    
                    $getUrunID = mysql_real_escape_string($_GET['UrunID']);
                    sepeteEkle($getUrunID);
                }
                
            

if(isset($_SESSION['sepet']) && !empty($_SESSION['sepet'])){
    $sepettekiUrunler = '';
    foreach ($_SESSION['sepet'] as $urunID=>$miktar){
        $sepettekiUrunler .= " $urunID ,";
    }
    
    $sepettekiUrunler = substr($sepettekiUrunler, 0,-1);
    
    //sepetteki ürünlerin alınması
    $querySepetUrun = "SELECT * FROM urun WHERE UrunID IN ($sepettekiUrunler) ORDER BY UrunID DESC";
    $rsSepetUrun = mysql_query($querySepetUrun);
    $row_rsSepetUrun = mysql_fetch_object($rsSepetUrun);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>E-Ticaret - Alışveriş Sepeti</title>
    <link href="_css/style.css" rel="stylesheet" type="text/css"/>
    <link href="_css/sepet.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php require_once 'views/header.php';?>
<div id="wrapper" class="w1180 center mTop20">
  
    <section class="w1180 mh500 fleft">
        <div id="content" class="mh500 fleft w1000">
            <link href="_css/urun.css" rel="stylesheet" type="text/css"/>
            <h1>Alışveriş Sepeti</h1>
            <div id="sepet" class="w1180 center mTop20">
                <?php
                
    if($sepetDurum==FALSE){
                          echo "<p>Sepetinizde ürün bulunmamamktadır</p>";
                    }
                
            
                if(isset($_SESSION['sepet']) && !empty($_SESSION['sepet'])){
                     $toplamFiyat = 0;
                    echo "<div id='sepet'>";
                   
                        echo "<div class='sepetHeader'>";
                        echo "<div class=sepetUrunResimHeader'></div>";
                        echo "<div class='sepetUrunAdiHeader'>Ürün Adı</div>";
                        echo "<div class='sepetUrunMiktarHeader'>Miktar</div>";
                        echo "<div class='sepetUrunFiyatHeader'>Fiyat</div>";
                        echo "<div class='sepetUrunToplamFiyatHeader'>Toplam Fiyat</div>";
                    echo "</div>";
                          $urunMiktar = 0;
                    do{
                  
                        $sepetUrunID = $row_rsSepetUrun->UrunID;
                        $urunMiktar = $_SESSION['sepet'][$sepetUrunID];
                        $urunFiyat = urunFiyatHesapla( $row_rsSepetUrun->UrunFiyat, $row_rsSepetUrun->KdvID);
                        $urunToplamFiyat = $urunFiyat * $urunMiktar;
                        $toplamFiyat += $urunToplamFiyat; 
                        echo "<div class='sepetUrun'>";
                        echo "<div class='sepetUrunResim'><img src='_uploads/resim/urun/$row_rsSepetUrun->UrunResim' width='50' height='50'></div>";
                                           echo "<div class='sepetUrunAdi'>$row_rsSepetUrun->UrunAdi</div>";
                                                echo "<div class='sepetUrunMiktar'>$urunMiktar</div>";
                        echo "<div class='sepetUrunFiyat'>" . number_format($urunFiyat,2). "TL</div>";
                           echo "<div class='sepetUrunToplamFiyat'>". number_format($urunToplamFiyat,2)."TL</div>";
                    echo "</div>";
                    }while($row_rsSepetUrun = mysql_fetch_object($rsSepetUrun));
                  
                    echo "<div class='sepetHeader'>";
                    echo "<div class='sepetUrunAdiFooter'>"
                    . "<span id='sepetSiparisVer'><a href='index.php'>Alışverişe Devam</a></span>"
                            ."<span id='sepetSiparisVer'><a href='siparis-tamamla.php'>Siparişi Tamamla</a></span>"
                            . "Toplam Ürün: ".sepetToplamUrun()."</div>";
                    echo "<div class='sepetUrunToplamFiyatFooter'>Toplam Fiyat: ". number_format($toplamFiyat,2) ."TL</div>";
                    echo "</div>";
                }else{
                       echo "<p class='kirmiziKutu'>Sepetinizde ürün bulunmamamaktadır</p>";
                }
                ?>
            </div>
        </div>
       
    </section>
</div>

</body>
</html>


