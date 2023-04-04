<?php
require_once '../../_inc/connection.php';

$gosterimTuruID = mysql_real_escape_string($_GET['GosterimTuruID']);

$sonuc = mysql_query("DELETE FROM urun_gosterim_turu WHERE GosterimTuruID = '$gosterimTuruID'");

if($sonuc){
    header("Location:index.php");
}
?>

