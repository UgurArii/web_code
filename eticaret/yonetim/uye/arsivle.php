<?php 
require_once '../../_inc/connection.php';

$uyeID = mysql_real_escape_string($_GET['UyeID']);

$query_Arsivle = "UPDATE uye_giris SET Aktif = 0 WHERE UyeID ='$uyeID'";

$sonuc = mysql_query($query_Arsivle);

if(sonuc){
    header("Location:index.php");
}
?>
