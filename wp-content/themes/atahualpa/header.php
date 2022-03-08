<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head><meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<?php /* if index.php or another page template (copied from index.php) was not used
(i.e. by a plugin such as WPG2), the global $bfa_ata would be empty */
global $bfa_ata; if ($bfa_ata == "") include_once (TEMPLATEPATH . '/functions/bfa_get_options.php'); ?>
<?php if ( get_query_var('preview') != 1 AND $bfa_ata['css_external'] == "External" ) { ?>
<link rel="stylesheet" href="<?php echo $bfa_ata['get_option_home']; ?>/?bfa_ata_file=css" type="text/css" />
<?php } ?>
<?php include (TEMPLATEPATH . '/functions/bfa_meta_tags.php'); ?>
<?php if ($bfa_ata['favicon_file'] != "") { ?>
<link rel="shortcut icon" href="<?php echo $bfa_ata['template_directory']; ?>/images/favicon/<?php echo $bfa_ata['favicon_file']; ?>" />
<?php } ?>
<?php if ( is_single() OR is_page() ) { ?>
<link rel="canonical" href="<?php the_permalink(); ?>" />
<?php } ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script type="text/javascript" src="<?php echo $bfa_ata['get_option_home']; ?>/wp-includes/js/jquery/jquery.js?ver=1.2.6"></script>

<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
 var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
 var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
   var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
   if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
 var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
   d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
 if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
 for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
 if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
 var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
  if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

<?php if ( get_query_var('preview') != 1 AND $bfa_ata['javascript_external'] == "External" ) { ?>
<script type="text/javascript" src="<?php echo $bfa_ata['get_option_home']; ?>/?bfa_ata_file=js"></script>
<?php } ?>
<?php if ( function_exists('wp_list_comments') AND is_singular() 
# AND $bfa_ata['include_wp_comment_reply_js'] == "No" 
) { 
	wp_enqueue_script( 'comment-reply' ); 
} ?>
<?php wp_head(); ?>
<?php echo ($bfa_ata['html_inserts_header'] != "" ? apply_filters(widget_text, $bfa_ata['html_inserts_header']) : ''); ?>
</head> 
<body onload="MM_preloadImages('/wp-content/themes/atahualpa/images/t-arts-on.png','/wp-content/themes/atahualpa/images/t-business-on.png','/wp-content/themes/atahualpa/images/t-energy-on.png','/wp-content/themes/atahualpa/images/t-health-on.png','/wp-content/themes/atahualpa/images/t-science-on.png','/wp-content/themes/atahualpa/images/t-politics-on.png', '/wp-content/themes/atahualpa/images/rss-on.gif', '/wp-content/themes/atahualpa/images/allauthors-on.gif','/wp-content/themes/atahualpa/images/alltopics-on.gif','/wp-content/themes/atahualpa/images/add-discussions-on.gif','/wp-content/themes/atahualpa/images/t-other-on.png','/wp-content/themes/atahualpa/images/add-posts-on.gif')" <?php body_class(); ?><?php echo ($bfa_ata['html_inserts_body_tag'] != "" ? ' ' . apply_filters(widget_text, $bfa_ata['html_inserts_body_tag']) : ''); ?>>
<?php echo ($bfa_ata['html_inserts_body_top'] != "" ? apply_filters(widget_text, $bfa_ata['html_inserts_body_top']) : ''); ?>
<div id="wrapper">
<div id="container">
<table id="layout" border="0" cellspacing="0" cellpadding="0">
<colgroup>
<?php if ( $bfa_ata['left_col'] == "on" ) { ?><col class="colone" /><?php } ?>
<?php if ( $bfa_ata['left_col2'] == "on" ) { ?><col class="colone-inner" /><?php } ?>
<col class="coltwo" />
<?php if ( $bfa_ata['right_col2'] == "on" ) { ?><col class="colthree-inner" /><?php } ?>
<?php if ( $bfa_ata['right_col'] == "on" ) { ?><col class="colthree" /><?php } ?>
</colgroup> 
	<tr>

		<!-- Header -->
		<td id="header" colspan="<?php echo $bfa_ata['cols']; ?>">

		<?php bfa_header_config($bfa_ata['configure_header']); ?>

		</td>
		<!-- / Header -->

	</tr>

	<!-- Main Body -->	
	<tr id="bodyrow">

		<?php if ( $bfa_ata['left_col'] == "on" ) { ?>
		<!-- Left Sidebar -->
		<td id="left">

			<?php // Widgetize the Left Sidebar 
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Sidebar') ) : ?>
		
					<div class="widget widget_categories"><div class="widget-title">
					<h3><?php _e('Categories','atahualpa'); ?></h3>
					</div><div class="widget-content">
					<ul>
						<?php wp_list_categories('show_count=1&title_li='); ?>
					</ul>
					</div></div>
					
					<div class="widget widget_archive"><div class="widget-title">
					<h3><?php _e('Archives','atahualpa'); ?></h3>
					</div><div class="widget-content">
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					</ul>
					</div></div>
									
			<?php endif; ?>

		</td>
		<!-- / Left Sidebar -->
		<?php } ?>

		<?php if ( $bfa_ata['left_col2'] == "on" ) { ?>
		<!-- Left INNER Sidebar -->
		<td id="left-inner">

			<?php // Widgetize the Left Inner Sidebar 
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Inner Sidebar') ) : ?>
		
					<!-- no default content for the LEFT INNER sidebar -->
									
			<?php endif; ?>

		</td>
		<!-- / Left INNER Sidebar -->
		<?php } ?>
		

		<!-- Main Column -->
		<td id="middle">
