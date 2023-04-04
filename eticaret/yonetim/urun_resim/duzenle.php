<?php 
require_once '../../_inc/connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title> </title>
    <link  href="../_css/tema/panel/style.css" rel="stylesheet" type="text/css" />
    <link href="../_css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
    <script src="../_js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="../_js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
    <script type="text/javascript">


$(function() {


$( "#tabs" ).tabs();




});
    </script>
</head>
<body>
  
    <header>
     <?php require '../_inc/header.php';?>  
    </header>
    <nav>
    <?php require '../_inc/nav.php';?>   
    </nav>
<section>
     <?php
    // put your code here
    ?>
    <h1>Sayfa Başlığı</h1>
</section>
         <?php require '../_inc/footer.php';?>   

</body>
</html>
