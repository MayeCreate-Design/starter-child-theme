<?php

// NOTE: To overwrite the script file in the parent theme uncomment this section and copy the mayecreate_sripts.js file into a folder called js in your child theme. Then edit that file.
/*add_action('wp_enqueue_scripts', 'mayecreate_script_fix', 100);
function mayecreate_script_fix()
{
    wp_dequeue_script('mayecreatejs');
    wp_dequeue_script('mc-block-editor-script');
    wp_enqueue_script( 'mc-block-editor-script_child', get_stylesheet_directory_uri() . '/js/mayecreate_scripts.js', false, '1.0', 'all' );
    wp_enqueue_script('child_theme_mayecreatejs', get_stylesheet_directory_uri().'/js/mayecreate_scripts.js', array('jquery'));
}*/

add_action( 'wp_enqueue_scripts', 'mc_enqueue_child_theme_styles', PHP_INT_MAX);
function mc_enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/css/main.min.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri().'/css/main.min.css', array('parent-style')  );
}

function parent_editor_style_setup() {
	// Add support for editor styles.
	add_editor_style(  get_template_directory_uri().'/css/main.min.css' );
}
add_action( 'after_setup_theme', 'parent_editor_style_setup' );

/* NOTE: These functions are functions that don't need to be in the parent theme because not every site will have them. */
function build_taxonomies() {
   register_taxonomy( 'projectcategory', 'menu', array( 'hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true, 'show_in_rest' => true ) );
}

function mayecreate_create_post_type_child() {
	
	// Register the "Project" custom post type if this is not needed, DELETE ME.
		register_post_type( 'projects',
			array(
				'labels' => array(
					'name'              => __( 'Projects'),
					'singular_name'     => __( 'Project' ),
					'add_new'           => __( 'Add Project' ),
					'add_new_item'      => __( 'Add New Project' ),
					'edit_item'         => __( 'Edit Project' ),  
					
				),
			'public' => true,
			'menu_position' => 10,
			'rewrite' => array('slug' => 'project', 'with_front' => false),
			'supports' => array('title','thumbnail','revisions','editor'),
			'menu_icon'         => 'dashicons-art',
			'taxonomies' => array('projectcategory'),
			'show_in_rest' => true,
			'has_archive' => true 
			)
		);
	
	// Register the "Team" custom post type if this is not needed, DELETE ME.
		register_post_type( 'team',
			array(
				'labels' => array(
					'name'              => __( 'Team'),
					'singular_name'     => __( 'Team Member' ),
					'add_new'           => __( 'Add Team Member' ),
					'add_new_item'      => __( 'Add New Team Member' ),
					'edit_item'         => __( 'Edit Team Member' ),  
					
				),
			'public' => true,
			'menu_position' => 10,
			'rewrite' => array('slug' => 'team', 'with_front' => false),
			'supports' => array('title','thumbnail','revisions','editor'),
			'menu_icon'         => 'dashicons-groups',
			'taxonomies' => array('teamcategory'),
			'has_archive' => true 
			)
		);
}
add_action( 'init', 'mayecreate_create_post_type_child' );
