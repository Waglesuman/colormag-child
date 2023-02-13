<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}
get_header();


echo '<div id="primary">
	<div id="content" class="clearfix">
		<div class="horizontal">';
		
		while (have_posts()):
				the_post();
				get_template_part('content', 'single');

				/* Getting the post meta data from the database. */
				$fullName = get_post_meta(get_the_ID(), 'full-name', true);
				$email = get_post_meta(get_the_ID(), 'email', true);
				$bio = get_post_meta(get_the_ID(), 'bio', true);
				$location = get_post_meta(get_the_ID(), 'location', true);
				$picture = get_post_meta(get_the_ID(), 'profilePicture', true);
				$image = wp_get_attachment_image_url($picture, 'large');

				// $unserializeData = unserialize(get_post_meta(get_the_ID(), 'post_serialize_array')[0]);
				/* Creating an array of the post meta data. */
				$variables = [
					"fullName" => $fullName,
					"email" => $email,
					"bio" => $bio,
					"location" => $location,
				];

				echo '<div class="user-info-container">' .
					'<img class="profile-picture" src="' . $image . '" alt="user profile image" width="100%">' .
					'<div class="user-info">
							<h4 class="full-name">Full Name: ' . $fullName . '</h4>
							<p class="email">Email: ' . $email . '	</p>
							<p class="bio">Bio: ' . $bio . '	</p>
							<p class="location">Location: ' . $location . ' </p>
				</div>
			</div>';

	// 		echo '<div class="user-info-container">' .
	// 		'<img class="profile-picture" src="' . $image . '" alt="user profile image" width="100%">' .
	// 		'<div class="user-info">
	// 				<h4 class="full-name">Full Name: ' . $unserializeData[0] . '</h4>
	// 				<p class="email">Email: ' .$unserializeData[2]. '	</p>
	// 				<p class="bio">Bio: ' . $unserializeData[3] . '	</p>
	// 				<p class="location">Location: ' . $unserializeData[4] . ' </p>
	// 	</div>
	// </div>';

			endwhile;
			echo '</div>' . '</div>' . '</div>';

			// colormag_sidebar_select();
			
			get_footer();