<? 
/**
 * It creates a shortcode(user_info_collection) that can be used in a page or post.
 */
function user_info_collection()
{
	ob_start();
	post_contact_form();
	return ob_get_clean();
}
add_shortcode('user_info_collection', 'user_info_collection');