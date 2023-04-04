<!DOCTYPE html>
<html>
<head>
     <title>Bootstrap Modals</title> 
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/custom.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           $("#packtpub").modal('show'); 
        });
    </script>
    <style>
             
        #packt{
         padding: 30px 30px 30px 30px;;
        }
    </style>
</head>
<body id="packt">

    <div id="packtpub" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-header">
               <button type="button" class="close" datadismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">Beware</h1>
            </div>
        <div class="modal-body">
<p>The Site has been blocked due to maliciouscontent</p>
<p class="text-warning"><small> Proceed at your own risk</small></p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" datadismiss="modal">Quit</button>
<button type="button" class="btn btn-danger">Proceed</button>
</div>
</div>
</div>

    
</body>
</html>
