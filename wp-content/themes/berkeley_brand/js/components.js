// Javascript for branded web components
var $j = jQuery;
$j(document).ready(function(){
	$j.ajaxSetup({
	    timeout: 10000
	});
	// Large Carousel
	var largeOwl = $j("#carouselHome"); 
	largeOwl.owlCarousel({
	
		nav : true, // Show next and prev buttons
		navText:[ "<span class='entypo chevron-thin-left'></span>", "<span class='entypo chevron-thin-right'></span>" ],
		slideSpeed : 300,
		paginationSpeed : 400,
		scrollPerPage: true,
		items : 1,
		loop: true,
		navElement:'button',
		singleItem:true
	
	});
	  
	  // Header Carousel
	  var headerOwl = $j("#carouselLanding");
	  headerOwl.owlCarousel({
	
	      nav : true, // Show next and prev buttons
	      navText:[ "<span class='entypo chevron-thin-left'></span>", "<span class='entypo chevron-thin-right'></span>" ],
	      slideSpeed : 300,
	      paginationSpeed : 400,
	      scrollPerPage: true,
	      items : 1,
	      loop: true,
	      navElement:'button',
	      singleItem:true
	 
	  });
	  
	  // Multi Item Carousel
	  var threeItemOwl = $j("#carouselMultiItems");
	  threeItemOwl.owlCarousel({
	
	      nav : true, // Show next and prev buttons
	      navText:[ "<span class='entypo chevron-thin-left'></span>", "<span class='entypo chevron-thin-right'></span>" ],
	      slideSpeed : 300,
	      paginationSpeed : 400,
	      scrollPerPage: true,
	      singleItem:false,
	      items : 3,
	      loop: true,
	      itemsDesktop : [1199,3],
	      itemsDesktopSmall : [979,3],
	      itemsMobile : true
	      // "singleItem:true" is a shortcut for:
	      // items : 1, 
	      // itemsDesktop : false,
	      // itemsDesktopSmall : false,
	      // itemsTablet: false,
	      // itemsMobile : false
	 
	  });
	  
	  $j('#og-more-toggle').click(function(){					   
			$j('#ogDrawer').slideDown('fast');
			return false;
		});
		  	  
		// Modal Carousel
		$j('.slideshow-modal').click(function(){
			$j('#modalSlideshow').modal('show');
			return false;
		});
		
		// Thumbnail Grid with Expanding Captions
//		var squareGrid = Grid( $j('#og-grid') );
//		squareGrid.init();
	
//		var circleGrid = Grid( $j('#og-grid-02') );
//		circleGrid.init();
		
//		$j('.og-more-toggle').click(function(){			
//			$j(this).parent().siblings('.ogDrawer').slideDown('fast'); 		 
//			return false;
//		});

		// Activate video modal		
		$j('.video-modal-trigger').click(function(event) {			
			var target_modal_id_str = $j(this).data("target");
			$j(target_modal_id_str).modal(options);
			var options = {
			    "backdrop" : "static",
				"show" :true,
				"keyboard" : true
			}
		  return false;
		});
	
		$j('.shareemail').click(function(e){
			e.preventDefault();
			var vidURL = $j(this).attr("name");
			var thisID = $j(this).parents(".modal").attr("id").substr(10);
			$j('#tellafriend'+thisID+' pre').append(vidURL);
			$j('#tellafriend'+thisID).show();
			$j('#video-container'+thisID).hide();
		});
		
		$j('.shareemail-hero').click(function(e){
			e.preventDefault();
			var vidURL = $j(this).attr("name");
			var vidTitle = $j(this).parents().siblings().find('h4').html();
			$j('#tellafriend-hero pre').append(vidURL);
			$j('#tellafriend-hero').show();
			$j('#video-container-hero').hide();
		});

		$j('.modal').on('hidden.bs.modal',function() {
			var thisID = $j(this).attr('id');
			var video = $j(this).find('.youtube').attr('id');
			var suffix = thisID.substr(10);
			if (thisID == 'videoModal') {
				$j('#tellafriend-hero').hide();
				$j("#video-container-hero").find("iframe").attr("src", $j("#video-container-hero").find("iframe").attr("src"));
				$j('#video-container-hero').show();
			} else if (thisID.indexOf('video') > -1) {
				$j('#tellafriend'+suffix).hide();
				$j('#video-container'+suffix).show();
				$j("#video-container"+suffix).find("iframe").attr("src", $j("#video-container"+suffix).find("iframe").attr("src"));
			}
		});

		$j('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			var thisID = $j(this).attr('href');
			if (thisID.indexOf('video') > -1) {
				var src = $j('#'+thisID+' > .embed-container').find('iframe').attr('src'); 
			$j('#'+thisID).find('iframe').attr('src', ''); 
			$j('#'+thisID).find('iframe').attr('src', src); 
		}
	});

	$j('.sharefacebook').click(function(){
		var shareURL = $j(this).attr('name');
	    var fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u="+shareURL, "fbshare", "width=600, height=400, scrollbars=no");
    	return false;
	});
  
	$j('.sharetwitter').click(function(){
		var tweetURL = $j(this).attr('name');
		var tweetText = $j(this).closest('.modal-content').find('h4').text();
		window.open("https://twitter.com/intent/tweet?text="+tweetText+"&url="+tweetURL, "fbshare", "width=600, height=400, scrollbars=no");
  	});

	$j(function () {
		var active = $j('.panel-group .panel-collapse.in').prev().addClass('active');
		active.find('a').append('<span class="glyphicon glyphicon-minus pull-right"></span>');
		$j('.panel-group .panel-heading').not(active).find('a').append('<span class="glyphicon glyphicon-plus pull-right"></span>');
		$j('.panel-group').on('show.bs.collapse', function (e) {
			$j('.panel-group .panel-heading.active').removeClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
			$j(e.target).prev().addClass('active').find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
		});
		$j('.panel-group').on('hide.bs.collapse', function (e) {
	    	$j(e.target).prev().removeClass('active').find('.glyphicon').removeClass('glyphicon-minus').addClass('glyphicon-plus');
		});
	});

  /* highlight active mega category */  
  $j(function() {
	  	var pathArray = window.location.pathname.split( '/' );		
		var secondLevelLocation = '/'+pathArray[1];
	  	$j('#\\'+secondLevelLocation+' a').eq(0).addClass('main_menu_selected');
	});
});
	

	  
		// JavaScript Document
		