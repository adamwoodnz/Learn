<?php

namespace WPOrg_Learn\Taxonomy;

defined( 'WPINC' ) || die();

/**
 * Actions and filters.
 */
add_action( 'init', __NAMESPACE__ . '\register' );
add_action( 'audience_add_form_fields', __NAMESPACE__ . '\register_custom_fields' );
add_action( 'topic_add_form_fields', __NAMESPACE__ . '\register_custom_fields' );
add_action( 'audience_edit_form_fields', __NAMESPACE__ . '\tax_edit_term_fields', 10, 2 );
add_action( 'topic_edit_form_fields', __NAMESPACE__ . '\tax_edit_term_fields', 10, 2 );
add_action( 'created_audience', __NAMESPACE__ . '\tax_save_term_fields' );
add_action( 'edited_audience', __NAMESPACE__ . '\tax_save_term_fields' );
add_action( 'created_topic', __NAMESPACE__ . '\tax_save_term_fields' );
add_action( 'edited_topic', __NAMESPACE__ . '\tax_save_term_fields' );

/**
 * Register all the taxonomies.
 */
function register() {
	register_lesson_audience();
	register_lesson_duration();
	register_lesson_group();
	register_lesson_instruction_type();
	register_lesson_level();
	register_lesson_plan_series();
	register_lesson_visibility();
	register_workshop_series();
	register_workshop_type();
	register_wp_version();
	register_included_content();
	register_topic();
	register_learning_pathway();
}

/**
 * Register the Lesson Audience taxonomy.
 */
function register_lesson_audience() {
	$labels = array(
		'name'                       => _x( 'Audiences', 'Taxonomy General Name', 'wporg-learn' ),
		'singular_name'              => _x( 'Audience', 'Taxonomy Singular Name', 'wporg-learn' ),
		'menu_name'                  => __( 'Audience', 'wporg-learn' ),
		'all_items'                  => __( 'All Audiences', 'wporg-learn' ),
		'parent_item'                => __( 'Parent Audience', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent Audience:', 'wporg-learn' ),
		'new_item_name'              => __( 'New Audience Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add Audience', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Audience', 'wporg-learn' ),
		'update_item'                => __( 'Update Audience', 'wporg-learn' ),
		'view_item'                  => __( 'View Audience', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate Audiences with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove Audiences', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular Audiences', 'wporg-learn' ),
		'search_items'               => __( 'Search Audiences', 'wporg-learn' ),
		'not_found'                  => __( 'Not Found', 'wporg-learn' ),
		'no_terms'                   => __( 'No Audiences', 'wporg-learn' ),
		'items_list'                 => __( 'Audiences list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Audiences list navigation', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'query_var'         => 'wporg_lesson_audience', // Prevent collisions with query params in the archive filter.
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_lesson_plans',
		),
	);

	register_taxonomy( 'audience', array( 'lesson-plan', 'lesson', 'course' ), $args );
}

/**
 * Register the Lesson Duration taxonomy.
 */
function register_lesson_duration() {
	$labels = array(
		'name'                       => _x( 'Duration', 'Taxonomy General Name', 'wporg-learn' ),
		'singular_name'              => _x( 'Duration', 'Taxonomy Singular Name', 'wporg-learn' ),
		'menu_name'                  => __( 'Duration', 'wporg-learn' ),
		'all_items'                  => __( 'All Durations', 'wporg-learn' ),
		'parent_item'                => __( 'Parent Duration', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent Duration:', 'wporg-learn' ),
		'new_item_name'              => __( 'New Duration', 'wporg-learn' ),
		'add_new_item'               => __( 'Add New Duration', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Duration', 'wporg-learn' ),
		'update_item'                => __( 'Update Duration', 'wporg-learn' ),
		'view_item'                  => __( 'View Duration', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate durations with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove durations', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular durations', 'wporg-learn' ),
		'search_items'               => __( 'Search durations', 'wporg-learn' ),
		'not_found'                  => __( 'Not Found', 'wporg-learn' ),
		'no_terms'                   => __( 'No durations', 'wporg-learn' ),
		'items_list'                 => __( 'Durations list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Durations list navigation', 'wporg-learn' ),
	);

	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'query_var'         => 'wporg_lesson_duration', // Prevent collisions with query params in the archive filter.
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_lesson_plans',
		),
	);

	register_taxonomy( 'duration', array( 'lesson-plan' ), $args );
}

/**
 * Register the Lesson Group taxonomy.
 */
function register_lesson_group() {
	$labels = array(
		'name'                       => _x( 'Lesson Groups', 'Lesson Plans associated to workshop group.', 'wporg-learn' ),
		'singular_name'              => _x( 'Lesson Group', 'Taxonomy Singular Name', 'wporg-learn' ),
		'menu_name'                  => __( 'Lesson Group', 'wporg-learn' ),
		'all_items'                  => __( 'All lesson groups', 'wporg-learn' ),
		'parent_item'                => __( 'Parent lesson group', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent lesson group:', 'wporg-learn' ),
		'new_item_name'              => __( 'New lesson group Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add Lesson Group', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit lesson group', 'wporg-learn' ),
		'update_item'                => __( 'Update lesson group', 'wporg-learn' ),
		'view_item'                  => __( 'View lesson group', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate lesson groups with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove lesson groups', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular lesson groups', 'wporg-learn' ),
		'search_items'               => __( 'Search lesson groups', 'wporg-learn' ),
		'not_found'                  => __( 'No lesson groups Found', 'wporg-learn' ),
		'no_terms'                   => __( 'No lesson groups', 'wporg-learn' ),
		'items_list'                 => __( 'Lesson groups list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Lesson groups list navigation', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_lesson_plans',
		),
	);

	register_taxonomy( 'lesson_group', array( 'lesson-plan' ), $args );
}

/**
 * Register the Lesson Instruction Type taxonomy.
 */
function register_lesson_instruction_type() {
	$labels = array(
		'name'                       => _x( 'Instruction Types', 'Taxonomy General Name', 'wporg-learn' ),
		'singular_name'              => _x( 'Instruction Type', 'Taxonomy Singular Name', 'wporg-learn' ),
		'menu_name'                  => __( 'Instruction Type', 'wporg-learn' ),
		'all_items'                  => __( 'All Instruction Types', 'wporg-learn' ),
		'parent_item'                => __( 'Parent Instruction Type', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent Instruction Type:', 'wporg-learn' ),
		'new_item_name'              => __( 'New Instruction Type Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add Instruction Type', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Instruction Type', 'wporg-learn' ),
		'update_item'                => __( 'Update Instruction Type', 'wporg-learn' ),
		'view_item'                  => __( 'View Instruction Type', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate Instruction Types with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove Instruction Types', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular Instruction Types', 'wporg-learn' ),
		'search_items'               => __( 'Search Instruction Types', 'wporg-learn' ),
		'not_found'                  => __( 'Not Found', 'wporg-learn' ),
		'no_terms'                   => __( 'No Instruction Types', 'wporg-learn' ),
		'items_list'                 => __( 'Instruction Types list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Instruction Types list navigation', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'query_var'         => 'wporg_lesson_type', // Prevent collisions with query params in the archive filter.
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_lesson_plans',
		),
	);

	register_taxonomy( 'instruction_type', array( 'lesson-plan' ), $args );
}

/**
 * Register the Lesson Level taxonomy.
 */
function register_lesson_level() {
	$labels = array(
		'name'                       => _x( 'Experience Levels', 'Taxonomy General Name', 'wporg-learn' ),
		'singular_name'              => _x( 'Experience Level', 'Taxonomy Singular Name', 'wporg-learn' ),
		'menu_name'                  => __( 'Experience Level', 'wporg-learn' ),
		'all_items'                  => __( 'All Experience Levels', 'wporg-learn' ),
		'parent_item'                => __( 'Parent Experience Level', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent Experience Level:', 'wporg-learn' ),
		'new_item_name'              => __( 'New Experience Level Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add New Experience Level', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Experience Level', 'wporg-learn' ),
		'update_item'                => __( 'Update Experience Level', 'wporg-learn' ),
		'view_item'                  => __( 'View Experience Level', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate experience levels with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove experience levels', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular Experience levels', 'wporg-learn' ),
		'search_items'               => __( 'Search Experience Levels', 'wporg-learn' ),
		'not_found'                  => __( 'Not Experience Found', 'wporg-learn' ),
		'no_terms'                   => __( 'No experience levels', 'wporg-learn' ),
		'items_list'                 => __( 'Experience Levels list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Experience Levels list navigation', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'query_var'         => 'wporg_lesson_level', // Prevent collisions with query params in the archive filter.
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'rewrite'           => false,
		'capabilities'      => array(
			'assign_terms' => 'edit_lesson_plans',
		),
	);

	register_taxonomy( 'level', array( 'lesson-plan', 'lesson', 'course' ), $args );
}

/**
 * Register the Lesson visibility taxonomy, used to hide lessons from the archive and search views.
 */
function register_lesson_visibility() {
	$labels = array(
		'name'                       => _x( 'Visibility', 'Taxonomy General Name', 'wporg-learn' ),
		'singular_name'              => _x( 'Visibility', 'Taxonomy Singular Name', 'wporg-learn' ),
		'menu_name'                  => __( 'Visibility', 'wporg-learn' ),
		'all_items'                  => __( 'All Visibilities', 'wporg-learn' ),
		'parent_item'                => __( 'Parent Visibility', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent Visibility:', 'wporg-learn' ),
		'new_item_name'              => __( 'New Visibility Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add New Visibility', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Visibility', 'wporg-learn' ),
		'update_item'                => __( 'Update Visibility', 'wporg-learn' ),
		'view_item'                  => __( 'View Visibility', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate visibilities with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove visibilities', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular Visibilities', 'wporg-learn' ),
		'search_items'               => __( 'Search Visibilities', 'wporg-learn' ),
		'not_found'                  => __( 'No Visibilities Found', 'wporg-learn' ),
		'no_terms'                   => __( 'No visibilities', 'wporg-learn' ),
		'items_list'                 => __( 'Visibilities list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Visibilities list navigation', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'query_var'         => 'wporg_lesson_visibility', // Prevent collisions with query params in the archive filter.
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'rewrite'           => false,
		'capabilities'      => array(
			'manage_terms' => 'manage_categories',
			'edit_terms'   => 'manage_categories',
			'delete_terms' => 'manage_categories',
			'assign_terms' => 'edit_lessons',
		),
	);

	// Use an existing taxonomy registered with Jetpack Search
	// See https://github.com/Automattic/jetpack/blob/36b2d5232e2ec3a1ad14034ab673fddce3acab97/projects/packages/sync/src/modules/class-search.php#L1479
	register_taxonomy( 'show', array( 'lesson' ), $args );
}

/**
 * Register the Lesson Plan Series taxonomy.
 */
function register_lesson_plan_series() {
	$labels = array(
		'name'                       => _x( 'Lesson Plan Series', 'taxonomy general name', 'wporg-learn' ),
		'singular_name'              => _x( 'Lesson Plan Series', 'taxonomy singular name', 'wporg-learn' ),
		'menu_name'                  => __( 'Series', 'wporg-learn' ),
		'all_items'                  => __( 'All Series', 'wporg-learn' ),
		'new_item_name'              => __( 'New Series Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add Series', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Series', 'wporg-learn' ),
		'update_item'                => __( 'Update Series', 'wporg-learn' ),
		'view_item'                  => __( 'View Series', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate series with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove series', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular Series', 'wporg-learn' ),
		'search_items'               => __( 'Search Series', 'wporg-learn' ),
		'not_found'                  => __( 'No series found', 'wporg-learn' ),
		'no_terms'                   => __( 'No series ', 'wporg-learn' ),
		'items_list'                 => __( 'Series list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Series list navigation', 'wporg-learn' ),
		'back_to_items'              => __( '&larr; Back to Series', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'rewrite'           => array(
			'slug' => 'lesson-plan-series',
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
	);

	register_taxonomy( 'wporg_lesson_plan_series', array( 'lesson-plan' ), $args );
}

/**
 * Register the Workshop Series taxonomy.
 */
function register_workshop_series() {
	$labels = array(
		'name'                       => _x( 'Tutorial Series', 'taxonomy general name', 'wporg-learn' ),
		'singular_name'              => _x( 'Tutorial Series', 'taxonomy singular name', 'wporg-learn' ),
		'menu_name'                  => __( 'Series', 'wporg-learn' ),
		'all_items'                  => __( 'All Series', 'wporg-learn' ),
		'new_item_name'              => __( 'New Series Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add Series', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Series', 'wporg-learn' ),
		'update_item'                => __( 'Update Series', 'wporg-learn' ),
		'view_item'                  => __( 'View Series', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate series with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove series', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular Series', 'wporg-learn' ),
		'search_items'               => __( 'Search Series', 'wporg-learn' ),
		'not_found'                  => __( 'No series found', 'wporg-learn' ),
		'no_terms'                   => __( 'No series ', 'wporg-learn' ),
		'items_list'                 => __( 'Series list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Series list navigation', 'wporg-learn' ),
		'back_to_items'              => __( '&larr; Back to Series', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'rewrite'           => array(
			'slug' => 'tutorials',
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_workshops',
		),
	);

	register_taxonomy( 'wporg_workshop_series', array( 'wporg_workshop' ), $args );
}

/**
 * Register the Topic taxonomy.
 */
function register_topic() {
	$labels = array(
		'name'                       => _x( 'Topics', 'Topics associated with the content.', 'wporg-learn' ),
		'singular_name'              => _x( 'Topic', 'Taxonomy Singular Name', 'wporg-learn' ),
		'menu_name'                  => __( 'Topics', 'wporg-learn' ),
		'all_items'                  => __( 'All topic', 'wporg-learn' ),
		'parent_item'                => __( 'Parent topic', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent topic:', 'wporg-learn' ),
		'new_item_name'              => __( 'New Topic Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add Topic', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Topic', 'wporg-learn' ),
		'update_item'                => __( 'Update Topic', 'wporg-learn' ),
		'view_item'                  => __( 'View Topic', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate Topic with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove Topic', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular Topics', 'wporg-learn' ),
		'search_items'               => __( 'Search Topics', 'wporg-learn' ),
		'not_found'                  => __( 'No Topic Found', 'wporg-learn' ),
		'no_terms'                   => __( 'No Topic ', 'wporg-learn' ),
		'items_list'                 => __( 'Topic list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Topic list navigation', 'wporg-learn' ),
		'back_to_items'              => __( '&larr; Back to topics', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'query_var'         => 'wporg_workshop_topic', // Prevent collisions with query params in the archive filter.
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'rewrite'           => false,
		'capabilities'      => array(
			'assign_terms' => 'edit_any_learn_content', // See \WPOrg_Learn\Capabilities\map_meta_caps.
		),
	);

	register_taxonomy( 'topic', array( 'lesson-plan', 'wporg_workshop', 'course', 'lesson', 'meeting' ), $args );
}

/**
 * Register the Workshop Type taxonomy.
 */
function register_workshop_type() {
	$labels = array(
		'name'                       => _x( 'Types', 'taxonomy general name', 'wporg-learn' ),
		'singular_name'              => _x( 'Type', 'taxonomy singular name', 'wporg-learn' ),
		'menu_name'                  => __( 'Types', 'wporg-learn' ),
		'all_items'                  => __( 'All types', 'wporg-learn' ),
		'parent_item'                => __( 'Parent type', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent type:', 'wporg-learn' ),
		'new_item_name'              => __( 'New Type Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add Type', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit Type', 'wporg-learn' ),
		'update_item'                => __( 'Update Type', 'wporg-learn' ),
		'view_item'                  => __( 'View Type', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate Types with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove Type', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular Types', 'wporg-learn' ),
		'search_items'               => __( 'Search Types', 'wporg-learn' ),
		'not_found'                  => __( 'No Type Found', 'wporg-learn' ),
		'no_terms'                   => __( 'No Type ', 'wporg-learn' ),
		'items_list'                 => __( 'Type list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Type list navigation', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'query_var'         => 'wporg_workshop_type', // Prevent collisions with query params in the archive filter.
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_workshops',
		),
	);

	register_taxonomy( 'wporg_workshop_type', array( 'wporg_workshop' ), $args );
}

/**
 * Register the WordPress Versions taxonomy.
 */
function register_wp_version() {
	$labels = array(
		'name'                       => _x( 'WordPress Version', 'taxonomy general name', 'wporg-learn' ),
		'singular_name'              => _x( 'WordPress Version', 'taxonomy singular name', 'wporg-learn' ),
		'menu_name'                  => __( 'WP Version', 'wporg-learn' ),
		'all_items'                  => __( 'All WordPress versions', 'wporg-learn' ),
		'new_item_name'              => __( 'New WordPress version', 'wporg-learn' ),
		'add_new_item'               => __( 'Add WordPress version', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit WordPress version', 'wporg-learn' ),
		'update_item'                => __( 'Update WordPress version', 'wporg-learn' ),
		'view_item'                  => __( 'View WordPress version', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate WordPress versions with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove WordPress version', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular WordPress versions', 'wporg-learn' ),
		'search_items'               => __( 'Search WordPress versions', 'wporg-learn' ),
		'not_found'                  => __( 'No WordPress version found', 'wporg-learn' ),
		'no_terms'                   => __( 'No WordPress versions', 'wporg-learn' ),
		'items_list'                 => __( 'WordPress version list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'WordPress version list navigation', 'wporg-learn' ),
		'back_to_items'              => __( '&larr; Back to WordPress Versions', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_any_learn_content', // See \WPOrg_Learn\Capabilities\map_meta_caps.
		),
	);

	$post_types = array( 'lesson-plan', 'wporg_workshop', 'course', 'lesson', 'meeting' );

	register_taxonomy( 'wporg_wp_version', $post_types, $args );
}

/**
 * Register the Included Content taxonomy.
 */
function register_included_content() {
	$labels = array(
		'name'                       => _x( 'Included Content', 'taxonomy general name', 'wporg-learn' ),
		'singular_name'              => _x( 'Included Content', 'taxonomy singular name', 'wporg-learn' ),
		'menu_name'                  => __( 'Included Content', 'wporg-learn' ),
		'all_items'                  => __( 'All included content', 'wporg-learn' ),
		'new_item_name'              => __( 'New included content', 'wporg-learn' ),
		'add_new_item'               => __( 'Add included content', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit included content', 'wporg-learn' ),
		'update_item'                => __( 'Update included content', 'wporg-learn' ),
		'view_item'                  => __( 'View included content', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate included content items with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove included content', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular included content items', 'wporg-learn' ),
		'search_items'               => __( 'Search included content', 'wporg-learn' ),
		'not_found'                  => __( 'No included content found', 'wporg-learn' ),
		'no_terms'                   => __( 'No included content', 'wporg-learn' ),
		'items_list'                 => __( 'Included content list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Included content list navigation', 'wporg-learn' ),
		'back_to_items'              => __( '&larr; Back to Included Content', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_any_learn_content', // See \WPOrg_Learn\Capabilities\map_meta_caps.
		),
	);

	$post_types = array( 'lesson-plan', 'wporg_workshop', 'course', 'lesson' );

	register_taxonomy( 'wporg_included_content', $post_types, $args );
}

/**
 * Register the Learning Pathway taxonomy.
 */
function register_learning_pathway() {
	$labels = array(
		'name'                       => _x( 'Learning Pathways', 'Taxonomy General Name', 'wporg-learn' ),
		'singular_name'              => _x( 'Learning Pathway', 'Taxonomy Singular Name', 'wporg-learn' ),
		'menu_name'                  => __( 'Learning pathway', 'wporg-learn' ),
		'all_items'                  => __( 'All learning pathways', 'wporg-learn' ),
		'parent_item'                => __( 'Parent learning pathway', 'wporg-learn' ),
		'parent_item_colon'          => __( 'Parent learning pathway:', 'wporg-learn' ),
		'new_item_name'              => __( 'New learning pathway Name', 'wporg-learn' ),
		'add_new_item'               => __( 'Add New learning pathway', 'wporg-learn' ),
		'edit_item'                  => __( 'Edit learning pathway', 'wporg-learn' ),
		'update_item'                => __( 'Update learning pathway', 'wporg-learn' ),
		'view_item'                  => __( 'View learning pathway', 'wporg-learn' ),
		'separate_items_with_commas' => __( 'Separate learning pathways with commas', 'wporg-learn' ),
		'add_or_remove_items'        => __( 'Add or remove learning pathways', 'wporg-learn' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wporg-learn' ),
		'popular_items'              => __( 'Popular learning pathways', 'wporg-learn' ),
		'search_items'               => __( 'Search learning pathways', 'wporg-learn' ),
		'not_found'                  => __( 'No learning pathway found', 'wporg-learn' ),
		'no_terms'                   => __( 'No learning pathways', 'wporg-learn' ),
		'items_list'                 => __( 'Learning pathways list', 'wporg-learn' ),
		'items_list_navigation'      => __( 'Learning pathways list navigation', 'wporg-learn' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => false,
		'public'            => true,
		'query_var'         => 'wporg_learning_pathway', // Prevent collisions with query params in the archive
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'capabilities'      => array(
			'assign_terms' => 'edit_others_posts',
		),
	);

	register_taxonomy( 'learning-pathway', array( 'course' ), $args );
}

/**
 * Add icon field for Category and Audience
 */
function register_custom_fields( $taxonomy ) {
	echo '<div class="form-field">
	<label for="dashicon-class">Dashicon ID</label>
	<input type="text" name="dashicon-class" id="dashicon-class" />
	<p>Enter the id of a <a href="https://developer.wordpress.org/resource/dashicons/#wordpress" target="_blank">Dashicon</a>. Example: <code>wordpress</code></p>
	</div>
	<div class="form-field">
	<label for="sticky">
	<input type="checkbox" name="sticky" id="sticky" />Sticky topic</label>
	<p>Check to show on landing page</p>
	</div>
	';
}

/**
 * Icon field on edit screen.
 *
 * @param object $term the term data.
 * @param array  $taxonomy the taxonomy array.
 */
function tax_edit_term_fields( $term, $taxonomy ) {
	$value  = get_term_meta( $term->term_id, 'dashicon-class', true );
	$sticky = get_term_meta( $term->term_id, 'sticky', true );

	echo '<tr class="form-field">
	<th>
		<label for="dashicon-class">Dashicon ID</label>
	</th>
	<td>
		<input name="dashicon-class" id="dashicon-class" type="text" value="' . esc_attr( $value ) . '" />
		<p>Enter the id of a <a href="https://developer.wordpress.org/resource/dashicons/#wordpress" target="_blank">Dashicon</a>. Example: <code>wordpress</code></p>
	</td>
	</tr>
	<tr class="form-field">
	<th>
		<label for="sticky">Sticky topic</label>
	</th>
	<td>
		<input name="sticky" id="sticky" type="checkbox" ' . esc_html( $sticky ? ' checked' : '' ) . ' />
		<p>Check to show on landing page</p>
	</td>
	</tr>
	';
}

/**
 * Save icon field.
 *
 * @param int $term_id the term id to update.
 */
function tax_save_term_fields( $term_id ) {
	$wp_list_table = _get_list_table( 'WP_Terms_List_Table' );

	if ( 'add-tag' === $wp_list_table->current_action() ) {
		check_admin_referer( 'add-tag', '_wpnonce_add-tag' );
	} else {
		check_admin_referer( 'update-tag_' . $term_id );
	}

	update_term_meta(
		$term_id,
		'dashicon-class',
		sanitize_text_field( $_POST['dashicon-class'] )
	);

	$is_sticky = $_POST['sticky'] ?? 0;
	update_term_meta(
		$term_id,
		'sticky',
		rest_sanitize_boolean( $is_sticky )
	);
}

/**
 * Get available taxonomy terms for a post type.
 *
 * @param string $taxonomy The taxonomy.
 * @param string $post_type The post type.
 * @param string $post_status The post status.
 * @return array The available taxonomy terms.
 */
function get_available_taxonomy_terms( $taxonomy, $post_type, $post_status = null ) {
	$posts = get_posts( array(
		'post_status'    => $post_status ?? 'any',
		'post_type'      => $post_type,
		'posts_per_page' => -1,
	) );

	if ( empty( $posts ) ) {
		return array();
	}

	$term_ids = array();
	foreach ( $posts as $post ) {
		$post_terms = wp_get_post_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) );

		if ( ! is_wp_error( $post_terms ) ) {
			$term_ids = array_merge( $term_ids, $post_terms );
		}
	}

	if ( empty( $term_ids ) ) {
		return array();
	}

	$term_ids = array_unique( $term_ids );

	$term_objects = get_terms( array(
		'taxonomy'   => $taxonomy,
		'include'    => $term_ids,
		'hide_empty' => false,
	) );

	return array_reduce( $term_objects, function( $terms, $term_object ) {
		$terms[ $term_object->slug ] = $term_object->name;
		return $terms;
	}, array());
}
