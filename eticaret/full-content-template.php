<?php
session_start();
require_once '_inc/connection.php';

if(!isset($_SESSION['UyeID'])){
    header("Location:uye-giris.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>E-Ticaret</title>
    <link href="_css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <header class="w1000 h100 center bradius3">
          <h1>Header İçeriği</h1>
    </header>
    <nav class="w1000 h40 center mTop20 bradius3">
        Menü Öğeleri
    </nav>
<div id="wrapper" class="w1000 center mTop20">

    <section class="w1000 mh500 fleft">
        <div id="content" class="mh500 fleft w1000">
        </div>
             </section>
        </div>
        
   


<footer class="w1000 center h100 mTop20">
    
    Footer Alanı
</footer>
</body>
</html>
