<!DOCTYPE html>
<html>
<head>
       <title>Bootstrap 3 Breadcrumbs</title>
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initialscale=1.0">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style type="text/css">
    .scroll-area{
        height: 500px;
        position: relative;
        overflow: auto;
    }    
    
#packt{
padding: 30px 30px 30px 30px;
}
</style>
</head>
<body id="packt">
<h2>ScrollSpy</h2>
<p>The ScrollSpy plugin is quite useful for automatically updating
nav targets based on scroll position. When you scroll the area below
the navbar,you can witness the change in the active class.It works for
dropdowns too.</p>
<nav id="myNavbar" class="navbar navbar-default" role="navigation">
<!-- Brand and toggle get grouped for better mobile display
-->
<div class="navbar-header">
<button type="button" class="navbar-toggle" datatoggle="
collapse" data-target="#navbarCollapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="#">Packt Publishing </a>
</div>
<div class="collapse navbar-collapse" id="navbarCollapse">
<ul class="nav navbar-nav">
<li class="active"><a href="#packt1">Packt Information</a></li>
<li><a href="#packt2">Ordering information</a></li>
<li><a href="#packt3">Terms and Conditions</a></li>
<li class="dropdown"><a href="#" class="dropdowntoggle"
data-toggle="dropdown">Blogs and Primers<b class="caret"></b></a>
<ul class="dropdown-menu">
<li><a href="#packtsub1">Blog</a></li>
<li><a href="#packtsub2">Tech Hub</a></li>
<li><a href="#packtsub3">Articles</a></li>
</ul>
</li>
</ul>
</div>
</nav>
</body>
</html>
