
function slideTo(index){
	var test=blueimp.Gallery(
		$('.galery-photo-list .thumbnail'),
		{
		titleProperty: 'title',
		onslide: function (index, slide) {
            node = this.container.find('.social-sidebar');
            node.empty();
            
            $(node).append($(".gallery-info").clone());

        	$(node).append('<div class="sidebar-element"><h3>' +
        		this.list[index].getAttribute('title')
        		+'</h3></div>');
        	$(node).append(
        		'<div class="sidebar-element"><div class="fb-like"'+
        		'data-colorscheme="dark" data-href="'+
				'http://google.fr' +
				//this.list[index].getAttribute('data-permalink') +
        		'" data-width="300" data-layout="standard"'+
        		'data-action="like" data-show-faces="true"'+
        		'data-share="true"></div></div>');
        	$(node).append(
        		'<div class="sidebar-element">'+
        		'<div class="fb-comments" data-width="500px"'+
        		'data-href="'+
        		'http://google.fr' +
        		//this.list[index].getAttribute('data-permalink') +
        		'" data-numposts="5"'+
        		'data-colorscheme="dark"></div></div>');
        	if(this.list[index].getAttribute('data-edit-link'))
        		$(node).append('<div style="text-align:center;"><a class="btn btn-primary" href="'+
        			this.list[index].getAttribute('data-edit-link') +
        			'"> Editer la photo </a></div>')
        	FB.XFBML.parse();
        }

		});
	test.slide(index,0);
}
