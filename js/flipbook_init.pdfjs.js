var isZoomedIn = false;
var beforeZoomScrollPos = 0;
var selectedEdition = '201311';
var currentPage = '1';
var isDeleting = false;
var papers;

var smallCanvases = [];
var bigCanvases = [];
var pdf = null;
var rendered = 0;

if(hash.get('e')) selectedEdition = hash.get('e');
if(hash.get('p')) currentPage = hash.get('p');

$("#flipbook").hide();
$("#arrow-left").hide();
$("#arrow-right").hide();
$("<img/>").attr("src", "/pics/ajax-loader.gif").addClass("ajax-loader").appendTo("#zoom-viewport");

$.getJSON( "/json/papers.json", function( data ) {
	papers = data;
	
	renderCanvases(selectedEdition)
});

function renderCanvases(edition) {
	PDFJS.disableWorker = true;
	smallCanvases = [];
	bigCanvases = [];
	
	PDFJS.getDocument("/pdfs/2013/november.pdf").then(function(_pdf) {
		pdf = _pdf;
		//Render all the pages on a single canvas
		for(var i = 0; i < pdf.numPages; i ++){ 
			renderPage(i + 1);
		}
		
		
	});
}

function renderPage(pnum) {
	pdf.getPage(pnum).then(function(page){
		var smallCanvas = document.createElement("canvas");
		var bigCanvas = document.createElement("canvas");
		var smallViewport = page.getViewport(464 / page.getViewport(1.0).width);
		var bigViewport = page.getViewport(1107 / page.getViewport(1.0).width);
		// changing canvas.width and/or canvas.height auto-clears the canvas
		smallCanvas.width = smallViewport.width;
		smallCanvas.height = smallViewport.height;
		bigCanvas.width = bigViewport.width;
		bigCanvas.height = bigViewport.height;
		
		page.render({canvasContext: smallCanvas.getContext('2d'), viewport: smallViewport});
		page.render({canvasContext: bigCanvas.getContext('2d'), viewport: bigViewport}).then(function(){
			rendered++;
			if(rendered == pdf.numPages - 1) init_flipbook();
		});
		
		smallCanvases[pnum-1] = smallCanvas;
		bigCanvases[pnum-1] = bigCanvas;
	});
}

function init_flipbook() {
	for (var i = 0; i < smallCanvases.length; i++) {
		$("#flipbook").append(createPage(i));
	}
	$("#zoom-viewport").find("img").remove();
	$("#flipbook").show();
	$("#arrow-left").show();
	$("#arrow-right").show();

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
}



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
	
	var img = bigCanvases[page-1];
	var prevImg = pageElement.find('canvas');
	
	$(prevImg).detach();
	$(img).appendTo(pageElement);

}

// Load small page

function loadSmallPage(page, pageElement) {

	var img = smallCanvases[page-1];
	var prevImg = pageElement.find('canvas');
	
	$(prevImg).detach();
	$(img).appendTo(pageElement);
}

function createPage(page) {
	var div = document.createElement('div');
	$(div).append(smallCanvases[page]);
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