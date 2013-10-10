var isZoomedIn = false;
var beforeZoomScrollPos = 0;
var selectedEdition = '201309';
var currentPage = '1';
var isDeleting = false;
var papers = new Array();
papers['201304'] = new Array();
papers['201304'][0] = "2013/april/";
papers['201304'][1] = 12;
papers['201309'] = new Array();
papers['201309'][0] = "2013/september/";
papers['201309'][1] = 16;
papers['201309'] = new Array();
papers['201309'][0] = "2013/october/";
papers['201309'][1] = 10;

if(hash.get('e')) selectedEdition = hash.get('e');
if(hash.get('p')) currentPage = hash.get('p');

for (var i = 0; i < papers[selectedEdition][1]; i++) {
	var div = createPage(selectedEdition, (i + 1));
	$("#flipbook").append(div);
}

$('#zoom-viewport').css("height", $('#flipbook').height());
$('#flipbook').css("left", $(window).width()/2 -$("#flipbook").width()/2);

$("#flipbook").turn({
	width: 927,
	height: 600,
	autoCenter: true,
	page: currentPage,
	when: {
		tap: function(event) {
			$('#flipbook').zoom('zoomIn', e);
		},
		turned: function(event, page, view) {
			if(!isDeleting) hash.add({ p: page });
		}
	}
});



	// Zoom.js

	$('#zoom-viewport').zoom({
		flipbook: $('#flipbook'),
		max: function() { 
			
			return 2214/$('#flipbook').width();

		}, 
		when: {
			tap: function(event) {

				if ($(this).zoom('value')==1) {
					$('#flipbook').
						removeClass('animated').
						addClass('zoom-in');
					$(this).zoom('zoomIn', event);
				} else {
					$(this).zoom('zoomOut');
				}
			},

			resize: function(event, scale, page, pageElement) {

				if (scale==1)
					loadSmallPage(page, pageElement);
				else
					loadLargePage(page, pageElement);

			},

			zoomIn: function () {
				isZoomedIn = true;
				
				$('#flipbook').addClass('zoom-in');

				$("#arrow-left, #arrow-right").addClass("zoomed-in");
				$("#flipbook").css("margin-left", -$(window).width());
				
				$('#zoom-viewport').css("height", $(window).height());
				
				$(document).scrollTop($("#zoom-viewport").offset().top);
				beforeZoomScrollPos = $(document).scrollTop();
				$('body').css("overflow", "hidden");
			},

			zoomOut: function () {
				isZoomedIn = false;

				setTimeout(function(){
					$('#flipbook').addClass('animated').removeClass('zoom-in');
				}, 0);

				$("#arrow-left, #arrow-right").removeClass("zoomed-in");
				$('#zoom-viewport').css("height", $("#flipbook").height());
				
				$(document).scrollTop(beforeZoomScrollPos);
				$('body').css("overflow", "auto");
				$('#flipbook').css("top", "50%");
			},

			swipeLeft: function() {

				$('#flipbook').turn('next');

			},

			swipeRight: function() {
				
				$('#flipbook').turn('previous');

			}
		}
	});

	// Using arrow keys to turn the page

	$(document).keydown(function(e){

		var previous = 37, next = 39, esc = 27, space = 32;

		switch (e.keyCode) {
			case previous:

				// left arrow
				$('#flipbook').turn('previous');
				e.preventDefault();

			break;
			case next:

				//right arrow
				$('#flipbook').turn('next');
				e.preventDefault();

			break;
			case esc:
				
				$('#zoom-viewport').zoom('zoomOut');
				e.preventDefault();

			break;
			case space:
				if(isZoomedIn) $('#zoom-viewport').zoom('zoomOut');
				else $('#zoom-viewport').zoom('zoomIn');
				e.preventDefault();

			break;
		}
	});
	
	

// Load large page

function loadLargePage(page, pageElement) {
	
	var img = $('<img />');

	img.load(function() {

		var prevImg = pageElement.find('img');
		$(this).css({width: '100%', height: '100%'});
		$(this).appendTo(pageElement);
		prevImg.remove();
		
	});

	// Loadnew page
	
	img.attr('src', 'papers/'+ papers[selectedEdition][0] + '/page' +  page + '.jpg');
}

// Load small page

function loadSmallPage(page, pageElement) {
	
	var img = pageElement.find('img');

	img.css({width: '100%', height: '100%'});

	img.unbind('load');
	// Loadnew page

	img.attr('src', 'papers/'+ papers[selectedEdition][0] + 'page' +  page + '-small.jpg');
}

function createPage(edition, page) {
	var img = document.createElement('img');
	var div = document.createElement('div');
	img.src = 'papers/' + papers[edition][0] + 'page' + page + '-small.jpg';
	$(div).append(img);
	$(img).css({width: '100%', height: '100%'});
	return div;
}

function switchEdition(edition) {
	var currentPages = $("#flipbook").turn("pages");
	isDeleting = true;
	for (var i = 0; i < currentPages; i++) {
		$("#flipbook").turn("removePage", 1);
	}

	for (var i = 0; i < papers[edition][1]; i++) {
		var div = createPage(edition, (i + 1));
		$("#flipbook").turn("addPage", div);
	}
	isDeleting = false;
	selectedEdition = edition;
	hash.add({ e: edition });
}

$(window).resize(function() {
	if(isZoomedIn) {
		$('#zoom-viewport').css("height", $(window).height());
		$(document).scrollTop($("#zoom-viewport").offset().top);
	} else {
		$('#zoom-viewport').css("height", $("#flipbook").height());
	}
	$('#flipbook').css("left", $("#zoom-viewport").width()/2 -$("#flipbook").width()/2);
});

$(function(){

	$(window).hashchange( function(){
		if(hash.get('e')) {
			if(hash.get('e') != selectedEdition) {
				 selectedEdition = hash.get('e');
				 switchEdition(selectedEdition)
			}
		}
		if(hash.get('p')) {
			if(hash.get('p') != currentPage) {
				currentPage = hash.get('p');
				$("#flipbook").turn("page", currentPage);
			}
		}
	})

});