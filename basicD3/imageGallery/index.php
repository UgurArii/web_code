<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>A 3D Gallery</title>
        
       <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.7.3/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="css/application.css">
            <link href="application.css" rel="stylesheet" type="text/css"/>
            <script src="js/prefixfree.js" type="text/javascript"></script>
        
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/
jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/
selectivizr-min.js"></script>

</head>
<body>
<div>
    choose effect:
    <input type="radio" name="mode" id="opacity" checked/>
    <label for="opacity">Opatcity</label>
    <input type="radio" name="mode" id="slidein">
    <label for="slidein">slidein</label>
    <input type="radio" name="mode" id="cube" >
    <label for="cube">cube</label>
    <br />
    choose mode:
    <input type="radio" name="controls" id="animate">
    <label for="animate">animate</label>
    <input type="radio" name="controls" id="bullets" checked>
    <label for="bullets">bullets</label>
    <input type="radio" name="controls" id="arrows">
    <label for="arrows">arrows</label>
    <a id="picture1" name="picture1"></a>
    <a id="picture2" name="picture2"></a>
    <a id="picture3" name="picture3"></a>
    <a id="picture4" name="picture4"></a>
    <a id="picture5" name="picture5"></a>
    <section>
        <ul>
            <li>
                <figure id="shot1"></figure>
            </li>
              <li>
                <figure id="shot2"></figure>
            </li>
              <li>
                <figure id="shot3"></figure>
            </li>
              <li>
                <figure id="shot4"></figure>
            </li>
              <li>
                <figure id="shot5"></figure>
            </li>
        </ul>
        <span>
            <a href="#picture1" ></a>
            <a href="#picture2" ></a>
            <a href="#picture3" ></a>
            <a href="#picture4" ></a>
            <a href="#picture5" ></a>
        </span>
    </section>
</div>
</body>
</html>
