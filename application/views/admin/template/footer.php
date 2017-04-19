
</div>
	</div>
	
<footer id="footer-bar">
		<p id="footer-copyright">
			&copy; 2015 <a href="http://www.sykup.com/" target="_blank">Wapjude Tecch</a>
		</p>
	</footer>
	
	<!-- global scripts -->
        <?=App::Theme('js', 'jquery.js')?>
         <?=App::Theme('js', 'uses.js')?>
         <?=App::Theme("js", "App.js")?> 
      
	<?=App::Theme('js', 'bootstrap.js')?>
	
      <?=App::Theme('js', 'jquery.knob.js')?>
        <?=App::Theme('js', 'raphael-min.js')?>

        <?=App::Theme('js', 'morris.js')?>
	<?=App::Theme('js', 'scripts.js')?>
        <?=App::Theme("js", "fullcalendar.min.js")?>
      
        <script>
        $(function($) {
		
		graphBar2 = Morris.Bar({
			element: 'hero-bar',
			data: [
                            <?php foreach ($monthly_sales as $sales => $sale):?>
				{device: '<?=$sales?>', geekbench: <?=$sale["total_sales"]?>},
                           <?php endforeach;?>
				
			],
			barColors: ['#8bc34a', '#e84e40', '#f39c12', '#3fcfbb', '#626f70', '#8f44ad'],
			xkey: 'device',
			ykeys: ['geekbench'],
			labels: ['Sales'],
			barRatio: 0.4,
			xLabelAngle: 35,
			hideHover: 'auto',
			resize: true
		});
		
		/* KNOB CHART LIBRARY */
		// Example of infinite knob, iPod click wheel
		var v, up=0,down=0,i=0
			,$idir = $("div.idir")
			,$ival = $("div.ival")
			,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
			,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
			
		$("input.infinite").knob({
			min : 0
			, max : 20
			, stopper : false
			, change : function () {
				if(v > this.cv){
					if(up){
						decr();
						up=0;
					}else{up=1;down=0;}
				} else {
					if(v < this.cv){
						if(down){
							incr();
							down=0;
						}else{down=1;up=0;}
					}
				}
				v = this.cv;
			}
		});
	});
        </script>
   
	<!-- this page specific inline scripts -->
        
	
  
	
</body>

<!-- Mirrored from superhero.phoonio.com/v1-2/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 26 Feb 2015 22:55:12 GMT -->
</html>