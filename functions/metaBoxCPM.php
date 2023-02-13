<?
// creating meta box and adding to the post type user_info_collection
function add_custom_meta_box()
{
	add_meta_box('custom_meta_box',
					'User Info Collection Details',
					'render_custom_meta_box',
					'user_info_collection',
					// specify the custom post type
					'normal',
					'high'
	);
}
add_action('add_meta_boxes', 'add_custom_meta_box');

/* A function that creates a custom meta box and adds it to the post type user_info_collection. */
function render_custom_meta_box($post)
{
	// Add a nonce field so we can check for it later
	wp_nonce_field('custom_meta_box', 'custom_meta_box_nonce');

	// Get the existing data
	$full_name = get_post_meta($post->ID, 'full-name', true);
	$email = get_post_meta($post->ID, 'email', true);
	$bio = get_post_meta($post->ID, 'bio', true);
	$location = get_post_meta($post->ID, 'location', true);
	$image = wp_get_attachment_image_url(get_post_meta(get_the_ID(), 'profilePicture', true), 'large');

	// Output the fields
	?>
	<p>
		<label for="full_name">Full Name:</label>
		<input class="widefat" type="text" id="full_name" name="full_name" value="<?php echo esc_attr($full_name); ?>" />
	</p>
	<p>
		<label for="email">Email:</label>
		<input class="widefat" type="email" id="_email" name="_email" value="<?php echo esc_attr($email); ?>" />
	</p>
	<p>
		<label for="bio">Bio:</label>
		<textarea class="widefat" id="bio" name="_bio" required><?php echo esc_textarea($bio); ?></textarea>
	</p>
	<p>
		<label for="location">Location:</label>
		<input class="widefat" type="text" id="location" name="_location" value="<?php echo esc_attr($location); ?>" />
	</p>
	<p>
		<?php echo '<img class="displayImage" src="' . $image . '" alt="user profile image" width="100%">'; ?>
	</p>
	<?php
}

/**
 * It checks if the nonce is set, verifies the nonce, checks if the post is an autosave, checks if the
 * user has permission to edit the post, and then updates the post meta fields
 * 
 * @param post_id The ID of the post that we're saving the meta data for.
 * 
 * @return the value of the post meta field.
 */
function save_custom_meta_box($post_id)
{
	// Check if nonce is
	if (!isset($_POST['custom_meta_box_nonce'])) {
		return;
	}
	// Verify nonce
	if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], 'custom_meta_box')) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything
	// if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
	// 	return;
	// }

	// Check the user's permissions
	// if (!current_user_can('edit_post', $post_id)) {
	// 	return;
	// }

/* Updating the post meta fields. */
	update_post_meta($post_id, 'full-name', sanitize_text_field($_POST['full_name']));
	update_post_meta($post_id, 'email', sanitize_email($_POST['_email']));
	update_post_meta($post_id, 'bio', sanitize_textarea_field($_POST['_bio']));
	update_post_meta($post_id, 'location', sanitize_text_field($_POST['_location']));

}
add_action('save_post', 'save_custom_meta_box');