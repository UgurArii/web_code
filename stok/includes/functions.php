<?php

function getValues($value)
{
    //msql_real_escape_string
    $value = mysql_real_escape_string($value);
    
    //trim-sol sağ boşluk
    $value = trim($value);
    
    return $value;
    
}

function postValues($value)
{
      //msql_real_escape_string
    $value = mysql_real_escape_string($value);
    
    //trim-sol sağ boşluk
    $value = trim($value);
    
    return $value;
}

function parentKategoriBul($parentID){
    $query_rsParentKategori = "SELECT * FROM kategori WHERE KategoriID='$parentID'";
    $rsParentKategori = mysql_query($query_rsParentKategori);
    $row_rsParentKategori = mysql_fetch_object($rsParentKategori);
    
    
    return $row_rsParentKategori->Kategori;
    
}

//bir kategori içinde ürün var mı kontrol eder
function UrunVarmi($kategoriID)
{
    $query = "SELECT * FROM urun WHERE KategoriID='$kategoriID'";
    $result = mysql_query($query);
    $deger = mysql_num_rows($result);
    return $deger;
}

function GirisVarmi()
{
 if(empty($_SESSION['Uye']['UyeID']) || empty($_SESSION['Uye']['KullaniciAdi']) || empty($_SESSION['Uye']['Eposta']) || empty($_SESSION['Uye']['SeviyeID']))
{
   $girisVarmi = false;
}else{
    $girisVarmi = true;
}
}

function yetkiVarmi($seviyeID=6, $yetki=6, $uyeID=0, $modulID=0, $alan='')
{
    if($seviyeID<=$yetki)
    {
        //1.katman
        $yetkiVarmi=true;
        //2.katman
        $query = "SELECT $alan FROM modul_ue WHERE UyeID='$uyeID' AND ModulID='$modulID' AND $alan='1'";
        $result = mysql_query($query);
        $num_rows = mysql_num_rows($result);
        
        if($num_rows!=0){
            $yetkiVarmi=true;
        }else{
            $yetkiVarmi=false;
        }
        
        
    }elseif($yetki>=$seviyeID){
        $yetkiVarmi = false;
    }
    return $yetkiVarmi;
}

function phpSelf(){
    return $_SERVER['PHP_SELF'];
}

function modulAktifmi($dizinAdi)
{
    $query_rsModul = "SELECT ModulID, ModulAktif, ModulDizin FROM modul WHERE ModulDizin='$dizinAdi' AND ModulAktif=1";
    $rsModul = mysql_query($query_rsModul);
    $num_rsModul = mysql_num_rows($rsModul);
    
    // $aktif = empty($sonuc)?0:1;
    
    //return $aktif;
    return $num_rsModul;
}
?>
