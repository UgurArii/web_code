   <script type="text/javascript" src="<?=  Ayar::AyarAl("BaseURL");?>/js/highslide/highslide-full.js"></script>

<script type="text/javascript">
hs.graphicsDir = '<?=  Ayar::AyarAl("BaseURL");?>/js/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.fadeInOut = true;
hs.dimmingOpacity = 0.8;
hs.outlineType = 'rounded-white';
hs.captionEval = 'this.thumb.alt';
hs.marginBottom = 105; // make room for the thumbstrip and the controls
hs.numberPosition = 'null';

// Add the slideshow providing the controlbar and the thumbstrip
hs.addSlideshow({
	slideshowGroup: 'group1',
	interval: 5000,
	repeat: false,
	useControls: false,
	overlayOptions: {
		className: 'text-controls',
		position: 'bottom center',
		relativeTo: 'viewport',
		offsetY: -60
	},
	thumbstrip: {
		position: 'bottom center',
		mode: 'horizontal',
		relativeTo: 'viewport'
	}
});
</script>
     <script type="text/javascript">
       //<![CDATA[
       hs.registerOverlay({
               html: '<div class="closebutton" onclick="return hs.close(this)" title="Close"></div>',
               position: 'top right',
               fade: 2 // fading the semi-transparent overlay looks bad in IE
       });


       hs.graphicsDir = '<?=  Ayar::AyarAl("BaseURL");?>/js/highslide/graphics/';
       hs.wrapperClassName = 'borderless';
       //]]>
       
       hs.Expander.prototype.onAfterClose = function() {
      //  window.location.reload();
};
       
       </script>
       <!--highslide kodları-->
    
    

    </script>
    
    <!--highslide bitisi-->
         <!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?=  Ayar::AyarAl("BaseURL");?>inc/js/fancy/source/jquery.fancybox.js?v=2.1.5"></script>

            <!-- fancy box tipi pencere sonu-->
        
        
        <script>
            $(function() { 
                    
            <?php 
                     if(isset($_GET['Tab'])){
                       $tab =$_GET['Tab'] ;
                     }   else{
                         
                         $tab='';
                     }
                        
                        switch ($tab) {
                            
                            
                            
                             case 'UrunAciklama':
                                $aktif=0;

                                break;

                            case 'UrunYorum':
                                $aktif=1;

                                break;
                            
                            case 'UrunTaksit':
                                $aktif=2;

                                break;

                               case 'UrunGorsel':
                                $aktif=3;

                                break;
                            
                            case 'UrunPufNokta':
                                $aktif=4;

                                break;
                            
                            default: 
                                $aktif=0;
                                break;
                        }
                        
                        
    
                    ?>
    

                    var aktif=<?=$aktif;?>;
		$( "#tabs" ).tabs({ active: aktif });
                
              $('.fancybox').fancybox(      {width:1040}     );
        
  
         
	
	});
            
            
	
	</script>
	
    
    
   