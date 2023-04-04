<?php
function markadaUrunVarMi($markaID){
    $query = "SELECT * FROM urun_profil WHERE MarkaID = '$markaID'";
    $result = mysql_query($query);
    
    $num_row = mysql_num_rows($result);
    
    return $num_row;
}

?>
