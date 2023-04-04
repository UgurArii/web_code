<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>A cube</title>
      <style>
body, html{
height: 100%;
width: 100%;
}

#container{
perspective: 500px;
backface-visibility: visible;
transform-style: 'preserve-3d';
position: relative;
height: 100%;
width: 100%;
perspective-origin: top left;
}
.square{
transform-style: 'preserve-3d';
position: absolute;
margin: -100px 0px 0px -100px;
top: 50%;
left: 50%;
height: 200px;
width: 200px;;
}
.back{
background: red;
transform: translateZ(-100px);
}
.left{
background: blue;
transform: rotateY(90deg) translateZ(-100px);
}
.right{
background: yellow;
transform: rotateY(-90deg) translateZ(-100px);
}
.front{
background: green;
transform: translateZ(100px);
}
.top{
background: orange;
transform: rotateX(-90deg) translateZ(-100px);
}
.bottom{
background: purple;
transform: rotateX(90deg) translateZ(-100px);
}

</style>
<script src="js/prefixfree.js" type="text/javascript"></script>
</head>
<body>
<div id="container">
    <div class="square back"></div>
<div class="square bottom"></div>
<div class="square right"></div>
<div class="square left"></div>
<div class="square top"></div>
<div class="square front"></div>
</div>
</body>
</html>
