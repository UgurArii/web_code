<?php
//ürün adı bulma
function urunAdiBul($urunID){
    $query = "SELECT * FROM urun WHERE UrunId=$urunID";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    
    return $row->UrunAdi;
}

//ürün resim var mı
function urunResimSayisi($urunID){
    
    //resimler için kayıt setinin oluşturulması
$query_rsUrunResim = "SELECT * FROM urun_resim WHERE UrunID='$urunID'";
$rsUrunResim = mysql_query($query_rsUrunResim);

$num_row_rsUrunResim = mysql_num_rows($rsUrunResim);
return $num_row_rsUrunResim;
}
?>
