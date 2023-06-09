<!DOCTYPE html>
<html>
<head>
       <title>Bootstrap ToolTips with Placement using JavaScript</</title>
    <meta charset="UTF-8">   
    <meta name="viewport" content="width=device-width, initialscale=1.0">

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function (){
    $(".packtpub1").tooltip({
    placement : 'left'
    });
    $(".packtpub2").tooltip({
    placement : 'top'
    });
    $(".packtpub3").tooltip({
    placement : 'right'
    });
    $(".packtpub4").tooltip({
    placement : 'bottom'
    });
});
</script>
<style type="text/css">
#packt{
padding: 150px 150px 150px 150px;
}
</style>
</head>
<body id="packt">
<div>
<button type="button" class="btn btn-primary packtpub1" datatoggle="
tooltip" title="Left Tooltip"> Hey Joe </button>
<hr><br><br>
<button type="button" class="btn btn-primary packtpub2" datatoggle="
tooltip" title="Top Tooltip"> Hey Joe </button>
<hr><br><br>
<button type="button" class="btn btn-primary packtpub3" datatoggle="
tooltip" title="Right ToolTip"> Hey Joe </button>
<hr><br><br>
<button type="button" class="btn btn-primary packtpub4" datatoggle="
tooltip" title="Bottom ToolTip"> Hey Joe </button>
</div>
</body>
</html>
