
function slideTo(index){
	var test=blueimp.Gallery(
		$('.galery-photo-list .thumbnail'),
		{
		titleProperty: 'title',
		onslide: function (index, slide) {
            node = this.container.find('.social-sidebar');
            node.empty();
            	$(node).append('<a href="#"> Test ' +
            		this.list[index].getAttribute('data-pass')
            		+'</a>');
            	$(node).append(
            		'<div class="fb-comments" data-width="400px"'+
            		'data-href="http://example.com/comments" data-numposts="5"'+
            		'data-colorscheme="dark"></div>');
            	FB.XFBML.parse();
        }

		});
	test.slide(index,0);
}
