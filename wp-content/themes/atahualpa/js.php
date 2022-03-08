<?php 
#global $bfa_ata; if ($bfa_ata == "") include_once (TEMPLATEPATH . '/functions/bfa_get_options.php'); 
if ( $bfa_ata['javascript_external'] == "Inline" ) {
	echo '<script type="text/javascript">'; 
} else { 
	header("Content-type: application/x-javascript"); 
}
if ( $bfa_ata['javascript_compress'] == "Yes" ) ob_start("bfa_compress_js");

function bfa_compress_js($buffer) {
	/* remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", "  ", "   ", "    "), '', $buffer);
	$buffer = str_replace(array(": ", " :"), ":", $buffer);
	$buffer = str_replace(array(" {", "{ "), "{", $buffer);
	$buffer = str_replace(array(" }", "} "), "}", $buffer);
	$buffer = str_replace(array(" (", "( "), "(", $buffer);
	$buffer = str_replace(array(" )", ") "), ")", $buffer);
	$buffer = str_replace(array(", ", " ,"), ",", $buffer);
	$buffer = str_replace(array("; ", " ;"), ";", $buffer);
	$buffer = str_replace(array("= ", " ="), "=", $buffer);
	return $buffer;
}


# if (function_exists('sociable_html')) {
# include (WP_PLUGIN_DIR.'/sociable/wists.js');
# }

?>
/* IE5.5+ PNG Alpha Fix v2.0 Alpha: Background Tiling Support
   (c) 2008 Angus Turnbull http://www.twinhelix.com

   This is licensed under the GNU LGPL, version 2.1 or later.
   For details, see: http://creativecommons.org/licenses/LGPL/2.1/  */

   
var IEPNGFix = window.IEPNGFix || {};

IEPNGFix.tileBG = function(elm, pngSrc, ready) {
	/* Params: A reference to a DOM element, the PNG src file pathname, and a
	   hidden "ready-to-run" passed when called back after image preloading. */

	var data = this.data[elm.uniqueID],
		elmW = Math.max(elm.clientWidth, elm.scrollWidth),
		elmH = Math.max(elm.clientHeight, elm.scrollHeight),
		bgX = elm.currentStyle.backgroundPositionX,
		bgY = elm.currentStyle.backgroundPositionY,
		bgR = elm.currentStyle.backgroundRepeat;

	/* Cache of DIVs created per element, and image preloader/data. */
	if (!data.tiles) {
		data.tiles = {
			elm: elm,
			src: '',
			cache: [],
			img: new Image(),
			old: {}
		};
	}
	var tiles = data.tiles,
		pngW = tiles.img.width,
		pngH = tiles.img.height;

	if (pngSrc) {
		if (!ready && pngSrc != tiles.src) {
			/* New image? Preload it with a callback to detect dimensions. */
			tiles.img.onload = function() {
				this.onload = null;
				IEPNGFix.tileBG(elm, pngSrc, 1);
			};
			return tiles.img.src = pngSrc;
		}
	} else {
		/* No image? */
		if (tiles.src) ready = 1;
		pngW = pngH = 0;
	}
	tiles.src = pngSrc;

	if (!ready && elmW == tiles.old.w && elmH == tiles.old.h &&
		bgX == tiles.old.x && bgY == tiles.old.y && bgR == tiles.old.r) {
		return;
	}

	/* Convert English and percentage positions to pixels. */
	var pos = {
			top: '0%',
			left: '0%',
			center: '50%',
			bottom: '100%',
			right: '100%'
		},
		x,
		y,
		pc;
	x = pos[bgX] || bgX;
	y = pos[bgY] || bgY;
	if (pc = x.match(/(\d+)%/)) {
		x = Math.round((elmW - pngW) * (parseInt(pc[1]) / 100));
	}
	if (pc = y.match(/(\d+)%/)) {
		y = Math.round((elmH - pngH) * (parseInt(pc[1]) / 100));
	}
	x = parseInt(x);
	y = parseInt(y);

	/* Handle backgroundRepeat. */
	var repeatX = { 'repeat': 1, 'repeat-x': 1 }[bgR],
		repeatY = { 'repeat': 1, 'repeat-y': 1 }[bgR];
	if (repeatX) {
		x %= pngW;
		if (x > 0) x -= pngW;
	}
	if (repeatY) {
		y %= pngH;
		if (y > 0) y -= pngH;
	}

	/* Go! */
	this.hook.enabled = 0;
	if (!({ relative: 1, absolute: 1 }[elm.currentStyle.position])) {
		elm.style.position = 'relative';
	}
	var count = 0,
		xPos,
		maxX = repeatX ? elmW : x + 0.1,
		yPos,
		maxY = repeatY ? elmH : y + 0.1,
		d,
		s,
		isNew;
	if (pngW && pngH) {
		for (xPos = x; xPos < maxX; xPos += pngW) {
			for (yPos = y; yPos < maxY; yPos += pngH) {
				isNew = 0;
				if (!tiles.cache[count]) {
					tiles.cache[count] = document.createElement('div');
					isNew = 1;
				}
				var clipR = (xPos + pngW > elmW ? elmW - xPos : pngW),
					clipB = (yPos + pngH > elmH ? elmH - yPos : pngH);
				d = tiles.cache[count];
				s = d.style;
				s.behavior = 'none';
				s.left = xPos + 'px';
				s.top = yPos + 'px';
				s.width = clipR + 'px';
				s.height = clipB + 'px';
				s.clip = 'rect(' +
					(yPos < 0 ? 0 - yPos : 0) + 'px,' +
					clipR + 'px,' +
					clipB + 'px,' +
					(xPos < 0 ? 0 - xPos : 0) + 'px)';
				s.display = 'block';
				if (isNew) {
					s.position = 'absolute';
					s.zIndex = -999;
					if (elm.firstChild) {
						elm.insertBefore(d, elm.firstChild);
					} else {
						elm.appendChild(d);
					}
				}
				this.fix(d, pngSrc, 0);
				count++;
			}
		}
	}
	while (count < tiles.cache.length) {
		this.fix(tiles.cache[count], '', 0);
		tiles.cache[count++].style.display = 'none';
	}

	this.hook.enabled = 1;

	/* Cache so updates are infrequent. */
	tiles.old = {
		w: elmW,
		h: elmH,
		x: bgX,
		y: bgY,
		r: bgR
	};
};


IEPNGFix.update = function() {
	/* Update all PNG backgrounds. */
	for (var i in IEPNGFix.data) {
		var t = IEPNGFix.data[i].tiles;
		if (t && t.elm && t.src) {
			IEPNGFix.tileBG(t.elm, t.src);
		}
	}
};
IEPNGFix.update.timer = 0;

if (window.attachEvent && !window.opera) {
	window.attachEvent('onresize', function() {
		clearTimeout(IEPNGFix.update.timer);
		IEPNGFix.update.timer = setTimeout(IEPNGFix.update, 100);
	});
}



/* Apply PNG fix for IE6 */

 if (document.all && /MSIE (5\.5|6)/.test(navigator.userAgent) &&
	document.styleSheets && document.styleSheets[0] && document.styleSheets[0].addRule) {
	document.styleSheets[0].addRule('*', 'behavior: url(<?php echo get_bloginfo('template_directory'); ?>/js/iepngfix.php)');
	/* Feel free to add rules for specific elements only, as above.
	You have to call this once for each selector, like so:
	document.styleSheets[0].addRule('img', 'behavior: url(<?php echo get_bloginfo('template_directory'); ?>/js/iepngfix.php)');
	document.styleSheets[0].addRule('div', 'behavior: url(<?php echo get_bloginfo('template_directory'); ?>/js/iepngfix.php)'); */
 }
 

/* JQUERY */


jQuery.noConflict();
jQuery(document).ready(function(){  
  
	/* For IE6 */
	if (jQuery.browser.msie && /MSIE 6\.0/i.test(window.navigator.userAgent) && !/MSIE 7\.0/i.test(window.navigator.userAgent)) {
	
		/* Max-width for images in IE6 */		
		var centerwidth = jQuery("td#middle").width(); 
		
		/* Images without caption */
		jQuery(".post img").each(function() { 
			var maxwidth = centerwidth - 10 + 'px';
			var imgwidth = jQuery(this).width(); 
			var imgheight = jQuery(this).height(); 
			var newimgheight = (centerwidth / imgwidth * imgheight) + 'px';	
			if (imgwidth > centerwidth) { 
				jQuery(this).css({width: maxwidth}); 
				jQuery(this).css({height: newimgheight}); 
			}
		});
		
		/* Images with caption */
		jQuery("div.wp-caption").each(function() { 
			var captionwidth = jQuery(this).width(); 
			var maxcaptionwidth = centerwidth + 'px';
			var captionheight = jQuery(this).height();
			var captionimgwidth =  jQuery("div.wp-caption img").width();
			var captionimgheight =  jQuery("div.wp-caption img").height();
			if (captionwidth > centerwidth) { 
				jQuery(this).css({width: maxcaptionwidth}); 
				var newcaptionheight = (centerwidth / captionwidth * captionheight) + 'px';
				var newcaptionimgheight = (centerwidth / captionimgwidth * captionimgheight) + 'px';
				jQuery(this).css({height: newcaptionheight}); 
				jQuery("div.wp-caption img").css({height: newcaptionimgheight}); 
				}
		});
		
		/* sfhover for LI:HOVER support in IE6: */
		jQuery("ul li").hover( 
		function() {
			jQuery(this).addClass("sfhover")
		}, 
		function() {
			jQuery(this).removeClass("sfhover")
		} 
		); 


	/* End IE6 */
	}
	
	
<?php if ($bfa_ata['table_hover_rows'] == "Yes") { ?>
	jQuery(".post table tr").
		mouseover(function() {
			jQuery(this).addClass("over");
		}).
		mouseout(function() {
			jQuery(this).removeClass("over");
		});
<?php } else { ?>
	jQuery(".post table.hover tr").
		mouseover(function() {
			jQuery(this).addClass("over");
		}).
		mouseout(function() {
			jQuery(this).removeClass("over");
		});	
<?php } ?>
	
<?php if ($bfa_ata['table_zebra_stripes'] == "Yes") { ?>
	jQuery(".post table tr:even").
		addClass("alt");
<?php } else { ?>
	jQuery(".post table.zebra tr:even").
		addClass("alt");	
<?php } ?>
	
<?php if ($bfa_ata['highlight_forms'] == "Yes") { ?>
	jQuery("input.text, input.TextField, input.file, input.password, textarea").
		focus(function () {  
			jQuery(this).addClass("highlight"); 
		}).
		blur(function () { 
			jQuery(this).removeClass("highlight"); 
		})
<?php } ?>
	
	jQuery("input.inputblur").
		focus(function () {  
			jQuery(this).addClass("inputfocus"); 
		}).
		blur(function () { 
			jQuery(this).removeClass("inputfocus"); 
		})
	
<?php if (function_exists('lmbbox_comment_quicktags_display')) { ?>
	jQuery("input.ed_button").
		mouseover(function() {
			jQuery(this).addClass("ed_button_hover");
		}).
		mouseout(function() {
			jQuery(this).removeClass("ed_button_hover");
		});
<?php } ?>
	
	jQuery("input.button, input.Button").
		mouseover(function() {
			jQuery(this).addClass("buttonhover");
		}).
		mouseout(function() {
			jQuery(this).removeClass("buttonhover");
		});

	/* toggle "you can use these xhtml tags" */
	jQuery("a.xhtmltags").
		click(function(){ 
			jQuery("div.xhtml-tags").slideToggle(300); 
		});

	/* For the Tabbed Widgets plugin: */
	jQuery("ul.tw-nav-list").
		addClass("clearfix");

	/* strech short pages to full height, keep footer at bottom */

});


<?php 

#if ( function_exists('wp_list_comments') AND $bfa_ata['include_wp_comment_reply_js'] == "Yes" ) 
#	include (ABSPATH . '/wp-includes/js/comment-reply.js'); 


if ( $bfa_ata['javascript_compress'] == "Yes" ) ob_end_flush(); 
if ( $bfa_ata['javascript_external'] == "Inline" ) echo '</script>'; 
?>