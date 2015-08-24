(function($){
	
	var child  = $('.wpp-list').children('li'),
		sliderUL = $('.wpp-list'),
		imgsHeight = 334, 
		imgsLen = child.length,
		current = 1,
		totalimgsLength = imgsLen * imgsHeight;


		$('.pop-slider-nav').on('click',function(){
			var direction =$(this).data('dir'),
				loc = imgsHeight;


			(direction === 'next') ? ++current : --current;

			//if first image
			if(current == 0){
				current = imgsLen;
				loc = totalimgsLength - imgsHeight;
				direction = 'next';
			}
			else if(current -1 === imgsLen){
				current = 1;
				loc = 0;
			}

			console.log(current);

			transition(sliderUL, loc, direction);
		})

		function transition(container,loc,direction){
			var unit;
			if(direction && loc !==0){
				unit = (direction === 'next' ? '-=' : '+=')
			}

			container.animate({
				'margin-top': unit ? (unit + loc) : loc 
			});
		}
})(jQuery);