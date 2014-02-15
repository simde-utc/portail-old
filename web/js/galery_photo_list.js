function slideTo(index){
	var test=blueimp.Gallery(
		$('.galery-photo-list .thumbnail'),
		{
		titleProperty: 'title',
        onclosed: function (){
            var location=window.location.href;
            var photo_in_location=location.indexOf('/photo');
            if(photo_in_location>0)
            history.pushState(
                {}, '', location.substring(0, photo_in_location));
        },
		onslide: function (index, slide) {
            node = this.container.find('.social-sidebar');
            node.empty();
            
            $(node).append($(".gallery-info").clone());

        	$(node).append('<div class="sidebar-element"><h3>' +
        		this.list[index].getAttribute('title')
        		+'</h3></div>');

            $(node).append('<div class="sidebar-element" title="Auteur de la photo"> ' +
                '<i class="fa-user fa fa-white fa-1g "> ' +
                this.list[index].getAttribute('data-author') +
                '</i></div>');

            $(node).append('<div class="sidebar-element" style="text-align:center;"> ' +
                '<a class="btn btn-primary fa-download fa fa-white fa-1g "' +
                    'href="'+ this.list[index].getAttribute('data-original-file') + '" download>' +
                'Télécharger en HD'+
                '</a></div>');

        	$(node).append(
        		'<div class="sidebar-element"><div class="fb-like"'+
        		'data-colorscheme="dark" data-href="'+
				this.list[index].getAttribute('data-permalink') +
        		'" data-width="300" data-layout="standard"'+
        		'data-action="like" data-show-faces="true"'+
        		'data-share="true"></div></div>');
        	$(node).append(
        		'<div class="sidebar-element">'+
        		'<div class="fb-comments" data-width="500px"'+
        		'data-href="'+
        		this.list[index].getAttribute('data-permalink') +
        		'" data-numposts="5"'+
        		'data-colorscheme="dark"></div></div>');

        	if(this.list[index].getAttribute('data-edit-link'))
        		$(node).append('<div style="text-align:center;"><a class="btn btn-primary" href="'+
        			this.list[index].getAttribute('data-edit-link') +
        			'"> Éditer la photo </a></div>')


        	FB.XFBML.parse();
            history.pushState({}, '', this.list[index].getAttribute('data-permalink'));

        }

		});
	test.slide(index,0);
}

$(function(){
    $('a.thumbnail').click(function (){
      slideTo($(this).data('photo-number'));
      return false;
    });
})
