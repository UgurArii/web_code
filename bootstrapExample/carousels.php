<!DOCTYPE html>
<html>
<head>
     <title>Bootstrap 3 Carousels</title> 
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <style type="text/css">
       .item{
background: #333;
text-align: center;
height: 300px !important;
}
.carousel{
margin-top: 20px;
}
.packt{
padding: 30px 30px 30px 30px;
}
    </style>
</head>
<body class="packt">
<div id="myCarousel" class="carousel slide" data-interval="500" date-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol> 
    <div class="carousel-inner">
        <div class="active item">
            <img src="angularjs_directives.jpg" alt="Packt"/>
            <div class="carousel-caption">
                <h6><b>Always finding a way</b></h6>
            </div>
        </div>
        <div class="item">
            <img src="angularjs_directives.jpg" alt=""/>
              <div class="carousel-caption">
                <h6><b>Always finding a way</b></h6>
              </div>
        </div>
         <div class="item">
            <img src="angularjs_directives.jpg" alt=""/>
              <div class="carousel-caption">
                <h6><b>Always finding a way</b></h6>
              </div>
        </div>
    </div>
    <!-- Carousel nav -->
<a class="carousel-control left" href="#myCarousel" dataslide="
prev">
<span class="glyphicon glyphicon-chevron-left"></span>
</a>
<a class="carousel-control right" href="#myCarousel" dataslide="
next">
<span class="glyphicon glyphicon-chevron-right"></span>
</a>
</div>
    
    
</body>
</html>
