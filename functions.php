<?php
if (!defined('KK_VERSION'))
	define('KK_VERSION', '1.0.0');

function kk_setup()
{
	/*
	 * Make theme i18n and l10n friendly
	 */
	load_theme_textdomain('kk', get_template_directory() . '/lang');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');
	add_theme_support('menus');
	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support('title-tag');
	/*
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	*/
	add_theme_support('post-thumbnails');
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		[
			'menu-top' => __('Top Page Menu', 'kk'),
			'menu-bottom' => __('Bottom Page Menu', 'kk'),
		]
	);
	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo'
	);
	add_theme_support( 'custom-header' );
}
add_action('after_setup_theme', 'kk_setup');

function kk_init_kk_post_type()
{
	
	register_post_type('kk_team', [
		'labels' => [
			'name' => 'Team',
			'singular_name'	=>	'Team',
			'add_new'	=>	'Add Member',
			'add_new_item'	=>	'Add New Member',
			'search_items'	=>	'Search Team',
			'new_item'	=>	'New Member',
			'view_item'	=>	'View Profile',
			'all_items'	=>	'Our Team',
			'not_found' =>	'Team member entry not found',
			'not_found_in_trash'	=>	'Team member entry not found in trash',
			'edit_item'	=>	'Edit Team Member',
			'menu_name'	=>	'Team'
		],
		'public' => true,
		'show_in_menu' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'supports' => ['editor', 'title','author','thumbnail','excerpt'],
		'menu_position' => 201
	]);

	register_post_type('kk_department', [
		'labels' => [
			'name' => 'Departments',
			'singular_name'	=>	'Department',
			'add_new'	=>	'Add Department',
			'add_new_item'	=>	'New Department',
			'search_items'	=>	'Search Departments',
			'new_item'	=>	'New Department',
			'view_item'	=>	'View Department',
			'all_items'	=>	'Our Departments',
			'not_found' =>	'Department  entry not found',
			'not_found_in_trash'	=>	'Department entry not found in trash',
			'edit_item'	=>	'Edit Department',
			'menu_name'	=>	'Department'
		],
		'public' => true,
		'show_in_menu' => true,
		'show_ui' => true,
		'publicly_queryable' => true,
		'supports' => ['editor', 'title','author','thumbnail','excerpt'],
		'menu_position' => 202
	]);
}
add_action('init', 'kk_init_kk_post_type');
add_action('init', 'kk_define_team_skill_taxonomy');

function kk_enqueue_scripts()
{
	wp_enqueue_style('kk-main-css', get_template_directory_uri() . '/css/main.css', [], KK_VERSION);
	wp_enqueue_script('kk-main-js', get_template_directory_uri() . '/js/main.js', [], KK_VERSION, true);
}
add_action('wp_enqueue_scripts', 'kk_enqueue_scripts');

add_action('admin_menu','kk_register_admin_menu');

function kk_define_team_skill_taxonomy()
{
	$labels = [
		'name'	=>	'Skills',
		'singular_name'	=>	'Skill',
		'search_items'	=>	'Search Skills',
		'all_items'	=>	'All Skills',
		'parent_item'	=>	'Parent',
		'parent_item_colon'	=>	'Parent:',
		'edit_item'	=>	'Edit Skill',
		'update_item'	=>	'Update Skill',
		'add_new_item'	=>	'Add New Skill',
		'new_item_name'	=>	'New Skill',
		'menu_name'	=>	'Skills'
	];

	$args = [
		'labels'	=>	$labels,
		'public'	=>	true,
		'hierarchical'	=>	true,
		'rewrite'	=>	true,
		'show_admin_column'	=>	true,
		
	];

	register_taxonomy('skills',['kk_team'],$args);

}

function kk_register_admin_menu(){
	add_menu_page(get_bloginfo( 'name' ),get_bloginfo( 'name' ),'manage_options','kodeklinik');
	add_submenu_page('kodeklinik',get_bloginfo( 'name' ).' Settings','Settings','manage_options','kodeklinik','kk_settings_cb',0);
	$posttypes = [201,202];
	global $menu,$submenu;
	foreach ($posttypes as $p) {
		$submenu['kodeklinik'][] = $menu[$p];
		unset($menu[$p]);
	}

	add_submenu_page('kodeklinik','Skills','Skills','manage_options','edit-tags.php?taxonomy=skills');
	
}
add_filter('excerpt_more','kk_modify_excerpt',999);
add_filter('excerpt_length','kk_modify_excerpt_length',999);
function kk_modify_excerpt($more)	{
	if (is_admin())	return $more;

	return	'...';
}

function kk_modify_excerpt_length($length) {
	if (is_admin()) return $length;
	return 30;
}


