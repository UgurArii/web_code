<?php 
require_once '../../_inc/connection.php';

$urunID = mysql_real_escape_string($_GET['UrunID']);

echo "Ürün ID : $urunID";

$query_Arsivle = "UPDATE urun SET UrunArsiv=0 WHERE UrunID='$urunID'";

$sonuc = mysql_query($query_Arsivle);

if(!$sonuc){
    header("Location:index.php");
}
?>
