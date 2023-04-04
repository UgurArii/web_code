<?php 
require_once '../../_inc/connection.php';

$seviyeID = mysql_real_escape_string($_GET['SeviyeID']);

$query_UyeSeviyeSil = "DELETE FROM uye_seviye WHERE SeviyeID = '$seviyeID'";

$sonuc = mysql_query($query_UyeSeviyeSil);

if($sonuc){
    header("Location:index.php");
}

?>
