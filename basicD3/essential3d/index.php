<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>experimenting with perspective</</title>
        
        <style>
body{
perspective: 500px;
transform-style: 'preserve-3d';
}
#red-square{
margin: auto;
width: 500px;
height: 500px;
background: red;
transform: rotateX(40deg);
}
    
</style>
<script src="js/prefixfree.js" type="text/javascript"></script>
</head>
<body>
<div id="red-square"></div>
</body>
</html>
