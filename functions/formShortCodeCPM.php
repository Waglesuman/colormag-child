<?
//Function thst creates a html form and saved its input data into post meta
function post_contact_form()
{

	/* Creating a form. */
	echo '<form onsubmit="return validateForm()" method="post" enctype="multipart/form-data"> 
	
    <label for="full-name">Full Name:</label> 
    <input type="text" id="full-name" name="full-name" required /><br>   

    <label for="email">Email:</label>
    <input type="text" id="email" name="email"  /><br>

    <label for="bio">Bio:</label></br>
     <textarea id="bio" name="bio" required /></textarea><br> 

    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required /><br>

		<label for="profilePicture">Profile Picture:</label>
		<input type="file" id="profilePicture" name="profilePicture" /> <br/> 
		
    <input type="submit" name="submit" value="Submit">
  </form>';

	if (isset($_POST['submit'])) {

		/* Taking the data from the form and assigning it to a variable. */
		$post_title = $_POST['full-name'];
		$post_fullname = $_POST['full-name'];
		$post_email = $_POST['email'];
		$post_bio = $_POST['bio'];
		$post_location = $_POST['location'];

		$post_serialized = serialize(
			[
				$post_title,
				$post_fullname,
				$post_email,
				$post_bio,
				$post_location,
			]
		);
		$post_arr = [
			'ID' => 0,
			'post_title' => $post_title,
			'post_type' => 'user_info_collection',
			'post_status' => 'publish',
			'meta_input' =>
			[
				'post_serialize_array' => $post_serialized,
			]
		];
		$post_id = wp_insert_post($post_arr);



		/* Creating a post and saving the data into post meta. */

		// $post_data = [
		// 	'post_title' => $post_title,
		// 	'post_status' => 'publish',
		// 	'post_author' => 1,
		// 	'post_type' => 'user_info_collection'
		// ];

		// $post_id = wp_insert_post($post_data);

		// if ($post_id) {
		// 	$data = [
		// 		'full-name' => $post_fullname,
		// 		'email' => $post_email,
		// 		'bio' => $post_bio,
		// 		'location' => $post_location,
		// 	];

		// 	foreach ($data as $key => $value) {
		// 		update_post_meta($post_id, $key, $value);
		// 	}
		// }

		/* Creating an array of data that will be used to create a new post. */
		// $post_arr = [
		// 	'ID' => 0,
		// 	'post_title' => $post_title,
		// 	'post_type' => 'user_info_collection',
		// 	'post_status' => 'publish',
		// 	'meta_input' =>
		// 	[
		// 		'post_fullname' => $post_fullname,
		// 		'post_email' => $post_email,
		// 		'post_bio' => $post_bio,
		// 		'post_location' => $post_location,
		// 	]
		// ];
		// $post_id = wp_insert_post($post_arr);

		// // /* Updating the post meta data. */
		// update_post_meta($post_id, 'full-name', $post_fullname);
		// update_post_meta($post_id, 'email', $post_email);
		// update_post_meta($post_id, 'bio', $post_bio);
		// update_post_meta($post_id, 'location', $post_location);

		if (!function_exists('wp_generate_attachment_metadata')) {
			media_files();
		}
		if ($_FILES) {
			foreach ($_FILES as $file => $array) {
				if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
					return "upload error : " . $_FILES[$file]['error'];
				}
				$attach_id = media_handle_upload($file, $post_id);
			}
		}
		if ($attach_id > 0) {
			//and if you want to set that image as Post  then use:
			update_post_meta($post_id, 'profilePicture', $attach_id);
		}


		//success message after submitting form 
		echo '<div class="success-message">Form submitted successfully! Thank you for your submission.</div>';
	}

}