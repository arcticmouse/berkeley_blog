<?php 
add_filter('more_fields_saved', 'more_fields_saved_for_inclusion_in_gateway_site');
function more_fields_saved_for_inclusion_in_gateway_site ($d) {
	$d['for-inclusion-in-gateway-site'] = maybe_unserialize('a:7:{s:5:"label";s:29:"For inclusion in Gateway site";s:8:"position";s:4:"left";s:5:"index";s:29:"for-inclusion-in-gateway-site";s:12:"ancestor_key";s:0:"";s:6:"fields";a:2:{s:18:"feature-on-gateway";a:8:{s:5:"label";s:19:"Feature on gateway?";s:3:"key";s:7:"feature";s:4:"slug";s:0:"";s:10:"field_type";s:8:"checkbox";s:6:"values";s:0:"";s:7:"caption";s:60:"Check this box to feature this blog post on the gateway site";s:5:"index";s:18:"feature-on-gateway";s:12:"ancestor_key";s:0:"";}s:15:"alternate-title";a:8:{s:5:"label";s:15:"Alternate Title";s:3:"key";s:9:"alt_title";s:4:"slug";s:0:"";s:10:"field_type";s:4:"text";s:6:"values";s:0:"";s:7:"caption";s:68:"This is the title that appears on the gateway site if selected below";s:5:"index";s:15:"alternate-title";s:12:"ancestor_key";s:0:"";}}s:15:"more_access_cap";a:2:{i:0;s:13:"administrator";i:1;s:6:"editor";}s:10:"post_types";a:1:{i:0;s:4:"post";}}', true); 
	return $d; 
}
?>