<?
/**
 * It creates a new post type called "User Info Collection" and makes it available to the public.
 */
function create_user_info_collection_post_type()
{
	register_post_type(
		'user_info_collection',
		[
			'labels' =>
			[
				'name' => __('User Info Collection'),
				'singular_name' => __('User Info Collection'),
			],
			'public' => true,
			'has_archive' => true,
			'show_ui' => true,
		]
	);
}
add_action('init', 'create_user_info_collection_post_type');