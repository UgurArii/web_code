<?php

function markaGoster($markaID){
    $query = "SELECT * FROM urun_marka WHERE MarkaID = '$markaID'";
    $result = mysql_query($query);
    $row = mysql_fetch_object($result);
    
    return $row->Marka;
}
?>
