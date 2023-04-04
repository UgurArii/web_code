<!DOCTYPE html>
<html>
<head>
       <title>Bootstrap Popovers</title>
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initialscale=1.0">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
 $(document).ready(function(){
     $(".packtpub a").popover({
        placement : 'top' 
     });
 });
 
    $(document).ready(function(){
   $(".pubman a").popover({
   placement : 'bottom'
   });
   });
</script>
<style type="text/css">
#packt{
padding: 150px 175px 175px 175px;
}
</style>
</head>
<body id="packt">
<div>
    <ul class="packtub">
        <li><a href="#" class="btn btn-default" data-toggle="popover"title="Musician" data-content="Awesome Vocalist">Jim Morrison</a></li>
<hr><br>
<li><a href="#" class="btn btn-success" data-toggle="popover"title="Scientist" data-content="Awesome Thinker">Stephen Hawking</a></li>
<hr><br>        
    </ul>
</div>
<div>
<ul class="pubman">
<li><a href="#" class="btn btn-danger" data-toggle="popover" title="Musician" data-content="Amazing guitarist">Jimi Hendrix</a></li>
<hr><br>
<li><a href="#" class="btn btn-primary" data-toggle="popover" title="Philosopher" data-content="Rational Thinker">Socrates</a></li>
</ul>
</div>
</body>
</html>
