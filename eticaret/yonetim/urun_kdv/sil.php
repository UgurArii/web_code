<?php
//mysql sunucusuna bağlanma
require_once '../../_inc/connection.php';

$kdvID = mysql_real_escape_string($_GET['KdvID']);

//Kdv Kayıt Seti
$query_KdvSil = "DELETE FROM urun_kdv WHERE KdvID='$kdvID'";

$sonuc = mysql_query($query_KdvSil);

if($sonuc){
    header("Location:index.php");
}

?>
