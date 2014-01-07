
function slideTo(index){
	var test=blueimp.Gallery(
		$('.galery-photo-list .thumbnail'),
		{
		titleProperty: 'title',
		onslide: function (index, slide) {
            node = this.container.find('.social-sidebar');
            node.empty();
            	$(node).append('<div class="sidebar-element"><a href="#"> Test ' +
            		this.list[index].getAttribute('data-pass')
            		+'</a></div>');
            	$(node).append('<div class="sidebar-element"><div class="fb-like" data-colorscheme="dark" data-href="http://assos.utc.fr/asso/etusexy" data-width="300" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div></div>')
            	$(node).append(
            		'<div class="sidebar-element"><div class="fb-comments" data-width="500px"'+
            		'data-href="http://example.com/comments" data-numposts="5"'+
            		'data-colorscheme="dark"></div></div>');
            	FB.XFBML.parse();
        }

		});
	test.slide(index,0);
}
