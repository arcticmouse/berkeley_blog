// JavaScript Document
jQuery(document).ready(function(){
	if (jQuery(".sandwich.pbsandwich_column")[0]){
		jQuery('.sandwich.pbsandwich_column .sandwich').first().find('.collapse').addClass('in');
		jQuery('.sandwich .panel .panel-body a').first().attr('aria-expanded', 'true');
	} else {
		jQuery('.sandwich').first().find('.collapse').addClass('in');
		jQuery('.sandwich .panel .panel-body a').first().attr('aria-expanded', 'true');
	}
	//jQuery('.sandwich .panel .panel-body a').attr('aria-expanded', 'true');
	
	jQuery('.sandwich .panel .panel-body a').click(function(){
		jQuery('.sandwich').find('.collapse').removeClass('in');
		if(jQuery('.sandwich .panel .panel-body a').attr('aria-expanded', 'true')) 
			jQuery('.sandwich .panel .panel-body a').attr('aria-expanded', 'false');
		jQuery(this).attr('aria-expanded', 'true');
	});
});