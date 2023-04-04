<?php


//fonksiyon formdan gelen değeri güvenli hale getirir ve sol-sağ boşlukarı temizler
function formDegerAl ($deger){
    $deger = mysql_real_escape_string($deger);
    
    $deger = trim($deger);
    return $deger;
}

    function urunAdiGoster($urunID){
        $query = "SELECT * FROM urun WHERE UrunID= '$urunID'";
        $result = mysql_query($query);
        
        $row = mysql_fetch_object($result);
        $urunAdi = $row->UrunAdi;
        return $urunAdi;
    }
    
    function urunProfilIDBul($urunID){
                $query = "SELECT UrunProfilID FROM urun_profil WHERE UrunID= '$urunID'";
        $result = mysql_query($query);
        
        $row = mysql_fetch_object($result);
        $num_row = mysql_num_rows($result);
        if($num_row>0){
        $profilID = $row->UrunProfilID;
        return $profilID;
        }else{
            return 0;
        }
        
    }
?>
