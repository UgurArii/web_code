<!DOCTYPE html>
<html>
<head>
     <title>Using the Bootstrap Grid classes</</title> 
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet"media="screen">
        <style>
            #packt{
                border-style: solid;
                border-color: black;
                color: #FF00FF;
            }
            #pub{
                border-style: solid;
                border-color: black;
                 color: #FF00FF;
            }
            #packtlib {
            border-style: dotted;
            border-color: lime;
            }
        </style>
</head>
<body>
<div class="container">
<h1>Hello, world!</h1>
<p>This is an example to show how to nest columns within the
allocated parent space</p>
<div class="row ">
<div class="col-lg-6" id="packtlib">
<h2>Columns can be nested within the space.</h2>
<div class="row" >
<div class="col-lg-6" id="packt">
<p>PacktLib is Packt's online digital book library.
Launched in August 2010, it allows you to access
and search almost 100,000 pages of book content,
to find the solutions you need. As part of the
Open Source community, Packt aims to help sustain
the projects which it publishes books on. Open
Source projects have received over $400,000
through this scheme to date.
</p>
</div>
<div class="col-lg-6" id="pub">
<p>Our books focus on practicality, recognising that
readers are ultimately concerned with getting the
job done. Packt's digitally-focused business model
allows us to publish up-to-date books in very
specific areas.With over 1000 books published,
Packt now offers a subscription service. This app
and a PacktLib subscription now makes finding the
information you need easier than ever before.
</p>
</div>
</div>
</div>
</div> <!-- the row class div -->
</div> <!-- the container div -->
</body>
</html>
