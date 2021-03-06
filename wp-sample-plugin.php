<?php
/*
Plugin Name: WordPress Sample Plugin
Plugin URI: https://github.com/aramakiyurie/wp-sample-plugin
Description: WordPress Plugin sample build.
Version: 1.0.0
Author: Yurie Aramaki
Author URI: https://github.com/aramakiyurie/wp-sample-plugin
License: GPLLv2 or later
*/
require_once( plugin_dir_path( __FILE__ ) . 'includes/wp-sample-admin-db.php' );
new Sample_Plugin();

class Sample_Plugin {
	/**
	*Constructer
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'create_table' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

/**
* Create Table.
*
*@version 1.0.0
*@since   1.0.0
*/
	public function admin_init() {
		wp_register_style( 'sample-plugin-style', plugins_url( 'css/style.css', __FILE__), array() ,'1.0.0' );
}
/**
* Add admin initialize
*
*@version 1.0.0
*@since   1.0.0
*/
	public function create_table() {
		$db = new Sample_Plugin_Admin_Db();
		$db->create_table();
}

/**
* Add admin menus
*
*@version 1.0.0
*@since   1.0.0
*/
	public function admin_menu() {
		add_menu_page(
			'サンプルA',
			'サンプルB',
			'manage_options',
			plugin_basename( __FILE__ ),
			array( $this, 'list_page_render' ),
			'dashicons-format-video'
		);
		$list_page = add_submenu_page(
			__FILE__,
			'サンプル一覧',
			'サンプル一覧',
			'manage_options',
			plugin_basename( __FILE__ ),
			array( $this, 'list_page_render' ),
			'dashicons-format-video'
		);
		$post_page = add_submenu_page(
			__FILE__,
			'サンプル登録',
			'サンプル登録',
			'manage_options',
			plugin_dir_path( __FILE__ ) . 'includes/wp-sample-plugin-post.php',
			array( $this, 'post_page_render' ),
			'dashicons-format-video'
		);
		add_action( 'admin_print_styles-' . $list_page, array( $this, 'add_style' ) );
		add_action( 'admin_print_styles-' . $post_page, array( $this, 'add_style' ) );
		add_action( 'admin_print_scripts-' . $post_page, array( $this, 'add_scripts' ) );
	}

	/**
	* REndaring List Page.
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function list_page_render (){
		require_once( plugin_dir_path( __FILE__ ) . 'includes/wp-sample-plugin-list.php');
		new Sample_Plugin_List();
	}

	/**
	* REndaring Post Page.
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function post_page_render (){
		require_once( plugin_dir_path( __FILE__ ) . 'includes/wp-sample-plugin-post.php');
		new Sample_Plugin_Post();
	}
	/**
	* Add style.
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function add_style (){
		wp_enqueue_style( 'sample-plugin-style' );
	}


	/**
	* Add scripts.
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function add_scripts (){
		wp_enqueue_media();
	}
}
