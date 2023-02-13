<?
function theme_customizer_function($wp_customize)
{

	$wp_customize->add_section(
		'landing_panel_home',
		[
			'title' => 'Header color',
			'panel' => 'colormag_global_panel',
		]
	);
	$wp_customize->add_setting(
		'landing_sec_title',
		[
			'default' => 'Landing Panel heading',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		]
	);

	/* Adding a partial refresh to the landing_sec_title theme mod. */
	// $wp_customize->selective_refresh->add_partial(
	//   'landing_sec_title',
	//   [
	//     'selector' => '.navbar-brand',
	//     'container_inclusive' => false,
	//     'render_callback' => function () {
	//       get_theme_mod('landing_sec_title');
	//     }
	//   ]
	// );

	/* Adding a control to Header in the customizer. */
	$wp_customize->add_control(
		'landing_sec_title',
		[
			'label' => 'Header',
			'section' => 'landing_panel_home',
			'priority' => 1,
		]
	);

}
add_action('customize_register', 'theme_customizer_function');