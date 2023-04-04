<?php
require_once '_inc/connection.php';
require_once '_inc/functions.php';
require_once '_inc/uye/functions.php';
require_once '_inc/genel/functions.php';

//header search kategori kayıt setinin oluşturulması
$query_rsHeaderAramaKategori = "SELECT * FROM urun_kategori WHERE ParentID=0";
$rsHeaderAramaKategori = mysql_query($query_rsHeaderAramaKategori);
$row_rsHeaderAramaKategori = mysql_fetch_object($rsHeaderAramaKategori);

//gerçek aktivasyon işlemleri
$eposta = mysql_real_escape_string($_GET['Eposta']);
$uyeID = mysql_real_escape_string($_GET['UyeID']);
$aktivasyon = mysql_real_escape_string($_GET['Aktivasyon']);
$kullaniciAdi = mysql_escape_string($_GET['KullaniciAdi']);
//query oluşturacağız
$query_rsUye = "SELECT * FROM uye_giris WHERE UyeID = '$uyeID' AND Eposta = '$eposta' AND Aktivasyon = '$aktivasyon' AND KullaniciAdi = '$kullaniciAdi'";
$rsUye = mysql_query($query_rsUye);
$num_row_rsUye = mysql_num_rows($rsUye);


if($num_row_rsUye>0){
    br();
    echo "Üye Bulundu";
  
            $uyeAktif = uyeAktifmi($UyeID);
            if($uyeAktif){
                echo "Üye Aktif yapılamayacak";
                header("Location:uye_giris.php?Islem=AktivasyonBasarisiz");
            }else{
                echo "ÜyeAktif Değil";
                header("Location:uye_giris.php?Islem=AktivasyonBasarili");
            }
      
            
}else{
    br();
    echo "Böyle bir üye bulunamadı";
}
?>



