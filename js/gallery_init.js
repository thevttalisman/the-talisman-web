var albumIds = [];
var gallery = {};
var fHash = hash;
var msnry;

$.getJSON( "photos.json", function( data ) {
	$.each( data, function( key, val ) {
		albumIds[albumIds.length] = val['id'];
		gallery[val['id']] = val;
	});
	
	init_gallery();
});			
function init_gallery() {
	if(!fHash.get('a')) {
		$("#content-wrapper").attr("class", "js-masonry");
		
		msnry = new Masonry(document.querySelector("#content-wrapper"), { "columnWidth": 236, "itemSelector": ".album-cover" });
		var elems = [];
		var fragment = document.createDocumentFragment();
		$.each(gallery, function( albumId, album ) {
			// Create the album card
			var elem = document.createElement('div');
			elem.setAttribute("class", "album-cover");
			elem.setAttribute("style", 'background-image: url(http://i.imgur.com/' + album['imgur_hashes'][Math.floor(Math.random() * album['imgur_hashes'].length)] + 'b.jpg); cursor: pointer;');
			elem.setAttribute("onclick", 'hash.add({ a: \"' + albumId + '\" })');
			
			// Add the title
			var p = document.createElement('p');
			$(p).append(album['name']);
			elem.appendChild(p);
			
			// some fancy masonry stuff
			fragment.appendChild( elem );
			elems.push( elem );
		});
		
		document.querySelector("#content-wrapper").appendChild(fragment);
		msnry.appended(elems);
	} else {
		$("#content-wrapper").append('<a href="#" class="back">&#x00ab; back</a><div class="galleria"></div>');
		
		// Generate Data Pack
		var albumRenderData = [];
		for(var i=0; i<gallery[fHash.get('a')]['imgur_hashes'].length;i++) {
			var hash = gallery[fHash.get('a')]['imgur_hashes'][i];
			var photoData = {};
			photoData['thumb'] = 'http://timthumb-thevttalisman.rhcloud.com/generate/?h=40&src=http://i.imgur.com/' + hash + 's.jpg',
			photoData['image'] = 'http://i.imgur.com/' + hash + 'l.jpg',
/* 				photoData['title'] = 'My title', */
			photoData['link'] = 'http://i.imgur.com/' + hash + '.jpg'
			albumRenderData.push(photoData);
		}
		
		// Load Galleria
		Galleria.loadTheme('js/galleria/themes/classic/galleria.classic.min.js');
		Galleria.run('.galleria', {
			dataSource: albumRenderData,
			width: 950,
			height: 497
		});

		
	}
}


$(function(){

	$(window).hashchange( function(){
		if(msnry != null) msnry.destroy();
		$("#content-wrapper").html('');
		init_gallery();
	})

});