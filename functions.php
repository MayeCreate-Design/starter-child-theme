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


