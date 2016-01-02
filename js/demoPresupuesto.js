$(document).ready(function() {
	
	


	$('.button1').click(function() {
		
		type = $(this).attr('data-type');
		typ = $(this).attr('type');

		if (type=='zoomin1') {
			alert(typ);
			$('.overlay-containera').fadeIn(function() {
			type= 'zoomin';
			window.setTimeout(function(){
				$('.window-containera.'+type).addClass('window-container-visiblea');
			}, 100);
			
		});

		$('.close').click(function() {
		$('.overlay-containera').fadeOut().end().find('.window-containera').removeClass('window-container-visiblea');
		});	

		}else{


		
		
		$('.overlay-container').fadeIn(function() {
			
			window.setTimeout(function(){
				$('.window-container.'+type).addClass('window-container-visible');
			}, 100);
			
		});

		};
	});
	
	$('.close').click(function() {
		$('.overlay-container').fadeOut().end().find('.window-container').removeClass('window-container-visible');
	});
	
});