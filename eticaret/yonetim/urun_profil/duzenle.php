<?php 
require_once '../../_inc/connection.php';
require_once '../_inc/functions.php';

//ürün profil ID
$urunProfilID = mysql_real_escape_string($_GET['UrunProfilID']);

//ürün profil kayıt seti
$query_rsUrunProfil = "SELECT * FROM urun_profil WHERE UrunProfilID = '$urunProfilID'";
$rsUrunProfil = mysql_query($query_rsUrunProfil);
$row_rsUrunProfil = mysql_fetch_object($rsUrunProfil);

//marka kayıt seti
$query_rsUrunMarka = "SELECT * FROM urun_marka ORDER BY Marka ASC";
$rsUrunMarka = mysql_query($query_rsUrunMarka);
$row_rsUrunMarka = mysql_fetch_object($rsUrunMarka);

if(isset($_POST['urunProfilDuzenleSubmit'])){
    //form verilerinin  alınması
    
    $markaID = mysql_real_escape_string($_POST['MarkaID']);
    $urunAciklama = mysql_real_escape_string($_POST['UrunAciklama']);
    $urunPuan = mysql_real_escape_string($_POST['UrunPuan']);
    $hediyePuan = mysql_real_escape_string($_POST['HediyePuan']);
    
    if(isset($_POST['Aktif'])){$aktif = 1;}else{$aktif=0;}
    
    //query oluşturulması ve güncellenmesi
    $query_UrunProfilDuzenle = "UPDATE urun_profil SET MarkaID='$markaID', UrunAciklama = '$urunAciklama', UrunPuan = '$urunPuan', HediyePuan='$hediyePuan', Aktif='$aktif' WHERE UrunProfilID='$urunProfilID'";
    
    $result = mysql_query($query_UrunProfilDuzenle);
    
    
    //yönlendirme
    if($result){
        header("Location:index.php?Islem=ProfilDuzenle");
    }
    
    }
    

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Ürün Profil Düzenle </title>
    <link  href="../_css/tema/panel/style.css" rel="stylesheet" type="text/css" />
    <link href="../_css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css"/>
    <script src="../_js/jquery-1.8.0.min.js" type="text/javascript"></script>
    <script src="../_js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script>
        <script src="../_js/tiny_mce/tiny_mce.js" type="text/javascript"></script>
    <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true, language : 'tr',

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
    <script type="text/javascript">


$(function() {


$( "#tabs" ).tabs();




});
    </script>
</head>
<body>
  
    <header>
     <?php require '../_inc/header.php';?>  
    </header>
    <nav>
    <?php require '../_inc/nav.php';?>   
    </nav>
<section>
   
    <h1>Ürün Profl Düzenle</h1>
    <h3><?php echo urunAdiGoster($row_rsUrunProfil->UrunID);?></h3>
    <form action="duzenle.php?UrunProfilID=<?= $urunProfilID;?>" method="post">
        <fieldset>
            <legend>Marka Bilgileri</legend>
            <label for="MarkaID">Ürünün Markası</label>
            <select id="MarkaID" name="MarkaID">
                <?php do{ ?>
                    <option value="<?= $row_rsUrunMarka->MarkaID ;?>"
                      <?php if($row_rsUrunMarka->MarkaID == $row_rsUrunProfil->MarkaID) { echo " selected";} ?>>
                      <?= $row_rsUrunMarka->Marka;?>
                    </option>      
               <?php } while($row_rsUrunMarka = mysql_fetch_object($rsUrunMarka)) ;?>
            </select>
        </fieldset>
        
        <fieldset>
            <legend>Ürün Bilgileri</legend>
            <label for="UrunAciklma">Ürün Açıklama</label>
            <textarea name="UrunAciklama" id="UrunAciklama" rows="25">
                <?= $row_rsUrunProfil->UrunAciklama;?>
            </textarea>
            <label for="UrunPuan">Ürün Puan</label>
            <input type="text" id="UrunPuan" name="UrunPuan" value="<?= $row_rsUrunProfil->UrunPuan;?>" />
            
            <label for="HediyePuan">Hediye Puan</label>
            <input type="text" id="UrunPuan" name="HediyePuan" value="<?= $row_rsUrunProfil->HediyePuan;?>" />
            
            <label for="Aktif">Aktif</label>
            <input type="checkbox" id="Aktif" name="Aktif" <?php if($row_rsUrunProfil->Aktif==1){echo " checked";}?> />
            <p>
            <input type="submit" name="urunProfilDuzenleSubmit" value="Değişiklikleri Kaydet" />
            </p>
        </fieldset>
    </form>
</section>
     
<footer>
    <p>ETicaret 2019</p>
</footer>
</body>
</html>
