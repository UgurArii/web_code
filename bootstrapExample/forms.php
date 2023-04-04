<!DOCTYPE html>
<html>
<head>
     <title>Using Bootstrap Grid Variables and Mixins</</title> 
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    <a href="css/style.less"></a>
    <style>
        #packt {
        padding-top: 25px;
        padding-bottom: 25px;
        padding-right: 50px;
        padding-left: 50px;
        }
    </style>
</head>
<body id="packt">
    <form role="form">
        <div class="form-group">
            <label for="enterusername"> Enter Email Address as the
Username</label>
            <input type="email" class="form-control" id="enterusername"
placeholder="Enter email">
        </div>
                <div class="form-group">
<label for="enterpassword">Password</label>
<input type="password" class="form-control"
id="enterpassword" placeholder="Password">
</div>
<br>
<div class="form-group">
<label for="filebrowse">Browse to find file</label>
<input type="file" id="filebrowse">
</div>
<br>
<div class="checkbox">
<label> <input type="checkbox"> Keep me signed in </label>
</div>
<br>
<div class="radio">
<label>
<input type="radio" name="optionsRadios" value="option1"
id="radio1">
Male
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="optionsRadios" value="option2"
id="radio2">
Female
</label>
</div>
<br>
<button type="submit" class="btn btn-default">Login</button>
    </form>
    
    <br/>
       <br/>
          <br/>
          <form role="form" class="form-inline">
<div class="form-group">
<label for="emailaddress" class="sr-only">Email
Address</label>
<input type="email" class="form-control" id="emailaddress"
placeholder="Enter email">
</div>
<div class="form-group">
<label for="enterpassword" class="sr-only">Password</label>
<input type="password" class="form-control"
id="enterpassword" placeholder="Password">
</div>
<br/><br/>
<div class="checkbox">
<label> <input type="checkbox"> Keep me signed in </label>
</div>
<br><br>
<div class="radio">
<label>
<input type="radio" name="optionsRadios" value="option1"
id="radio1">
Male
</label>
</div>
<div class="radio">
<label>
<input type="radio" name="optionsRadios" value="option2"
id="radio2">
Female
</label>
</div>
<br/><br/>
<p> Enter your comments in the following box </p>
<br>
<textarea rows="5" cols="70" placeholder="Your feedback is
important to us">
</textarea>
<br/><br/>
<button type="submit" class="btn btn-default">Login</button>
          </form>
          
          <br/>
          <br/>
          <form class="form-horizontal" role="form">
<div class="form-group" form-group-lg>
<label for="Email_user" class="col-sm-2 controllabel">
Login</label>
<div class="col-sm-4">
<input type="email" class="form-control" id="Email_user"
placeholder="Email OR Username">
</div>
</div>
<div class="form-group" form-group-sm>
<label for="inputPassword" class="col-sm-2 controllabel">
Password</label>
<div class="col-sm-4">
<input type="password" class="form-control"
id="inputPassword" placeholder="Password">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-4">
<button type="submit" class="btn btn-primary"> Login
</button>
</div>
</div>
</form>
          
          <br/>
          <code>The &lt;p&gt; element</code>
<pre>
&lt;p class="text-left">Left aligned text.&lt;/p&gt;
&lt;p class="text-center">Center aligned text.&lt;/p&gt;
&lt;p class="text-right">Right aligned text.&lt;/p&gt;
&lt;p&gt; Sample text here... &lt;/p&gt;
</pre>
          
          <br/>
          <br/>
          
          <img src="packt_sample.png" class="img-rounded" height="150"
width="130">
<br/><br/>
<img src="packt_sample.png" class="img-circle">
<br/><br/>
<img src="packt_sample.png" class="img-thumbnail" height="75"
width="75">
    
    <br/>
    <br/>
    
    <h1> Manipulating Bootstrap Base Css with LESS </h1>
<hr>
<h6> Packt Publishing </h2>
<p>Packt's mission is to help the world put software to work
in new ways.</p>
<hr>
<form role="form">
<div class="form-group">
<label for="enterusername"> Enter Email Address as the
Username</label>
<input type="email" class="form-control"
id="enterusername" placeholder="Enter email">
</div>
<div class="form-group">
<label for="enterpassword">Password</label>
<input type="password" class="form-control"
id="enterpassword" placeholder="Password">
</div>
<br>
<div class="form-group">
<label for="filebrowse">Browse to find file</label>
<input type="file" id="filebrowse">
</div>
<br><br>
<button type="submit" class="btn btnprimary">
Login</button>
</form>
</body>
</html>
