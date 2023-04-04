<?php

function resimUzantiBul($type){
    //resim mine tip alınır

    
    if($type=='image/jpeg'){
        $resimUzanti = "jpg";
    }else{
        $resimUzanti = str_replace('image/',' ', $type);
    }
    return $resimUzanti;
}

function resimYukle($tmp_name, $type, $path){

   $filename = $tmp_name;
   $resimAdi = resimAdiOlustur($type);
   $destination = $path.$resimAdi;
   move_uploaded_file($filename, $destination);
   return $resimAdi;
}

function resimAdiOlustur($type){
        $resimUzanti = resimUzantiBul($type);
    $resimIlkAd = md5(rand(0, 1000)). ".".$resimUzanti;
    $resimOnEk = rand(0,10000) ."-";
    $resimAdi = $resimOnEk.$resimIlkAd;
    return $resimAdi;
}

function resimThumbnailOlustur($tmp_name,$type,$thumPath){
  $resimThumbAdi = resimAdiOlustur($type);
  $resimUzanti = resimUzantiBul($type);
  $thumbPath = $thumPath.$resimThumbAdi;
  //resim boyutları
  $resimBoyut = getimagesize($tmp_name);
  $resimGenislik = $resimBoyut[0];
  $resimYukseklik = $resimBoyut[1];
  
  $resimTipi = resimTipiBul($resimGenislik, $resimYukseklik);
  
  switch ($resimTipi){
      case  "Kare":
          $thumbGenislik ="100";
          $thumbYukseklik = "100";
          break;
  
      case "YatayDortgen":
               $thumbGenislik ="100";
          $oran = $thumbGenislik/$resimGenislik;
          $thumbYukseklik = $oran * $thumbYukseklik;
          $thumbYukseklik = round($thumbYukseklik);
          break;
  
       case "DikeyDortgen":
          $thumbYukseklik ="100";
          $oran = $thumbYukseklik/$resimYukseklik;
          $thumbGenislik = $oran * $thumbYukseklik;
          $thumbGenislik = round($thumbYukseklik);
          break;
  }
  
  switch ($resimUzanti){
      case 'jpg' :
          $img = imagecreatefromjpeg($tmp_name);
          
          $thumb = imagecreatetruecolor($thumbGenislik, $thumbYukseklik);
          
          imagecopyresized($thumb, $image, 0, 0, 0, 0, $thumbGenislik, $thumbYukseklik, $resimGenislik, $resimYukseklik);
          
          imagejpeg($thumb, $thumPath,100);
          break;
      case 'png':
             $img = imagecreatefrompng($tmp_name);
          $thumb = imagecreatetruecolor($thumbGenislik,$thumbYukseklik);          
          imagecopyresized($thumb, $image, 0, 0, 0, 0, $thumbGenislik, $thumbYukseklik, $thumbYukseklik, $resimYukseklik);          
          imagepng($thumb, $thumPath,9);
          break;
      case 'gif':
           $img = imagecreatefromgif($tmp_name);
          $thumb = imagecreatetruecolor($thumbGenislik, $thumbYukseklik);          
          imagecopyresized($thumb, $image, 0, 0, 0, 0, $thumbGenislik, $thumbYukseklik, $thumbYukseklik, $resimYukseklik);          
          imagegif($thumb, $thumPath);
          break;
      case 'bmp':
           $img = imagecreatefrombmp($tmp_name);
          $thumb = imagecreatetruecolor($thumbGenislik, $thumbYukseklik);          
          imagecopyresized($thumb, $image, 0, 0, 0, 0, $thumbGenislik, $thumbYukseklik, $thumbYukseklik, $resimYukseklik);          
          image2wbmp($thumb, $thumPath);
          break;
  }
  return $resimThumbAdi;
}

function resimTipiBul($resimGenislik, $resimYukseklik){
    if($resimGenislik==$resimYukseklik){
        return 'kare';
    }else if($resimGenislik>$resimYukseklik){
        return 'YatayDortgen';
    }else{
        return 'DikeyDortgen';
    }
}
?>
