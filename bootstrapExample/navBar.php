<!DOCTYPE html>
<html>
<head>
       <title>Bootstrap Nav and Nav Tabs</title>
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initialscale=1.0">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style type="text/css">
#packt{
padding: 30px;
}
</style>
</head>
<body class="packt">
<div>
    <nav role="navigation" class="navbar navbar-default">
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="#" class="navbar-brand">Packt Publishing</a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
           <ul class="nav navbar-nav">
                    <li class="active"><a href="#"> Books and Videos </a></li>
                    <li><a href="#"> Articles </a></li>
                    <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle"href="#"> Categories <b class="caret"></b></a>
                    <ul role="menu" class="dropdown-menu">
                    <li><a href="#"> Web development </a></li>
                    <li><a href="#"> Game Development </a></li>
                    <li><a href="#"> Big Data and Business Intelligence </a></li>
                    <li><a href="#"> Virtualization and Cloud </a></li>
                    <li><a href="#"> Networking and Servers </a></li>
                    <li class="divider"></li>
                    <li><a href="#"> Miscellaneous </a></li>
                    </ul>
                    </li>
                    <li><a href="#"> Support </a></li>
            </ul>
                    <form role="search" class="navbar-form navbar-right">
            <div class="form-group">
            <input type="text" placeholder="Search Here"
            class="form-control">
            </div>
            </form>
</div>
    </nav>
</div>
  
</body>
</html>
