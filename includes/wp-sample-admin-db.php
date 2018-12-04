<?php

/**
* Class List Page
*
*@author Yurie Aramaki
*@version 1.0.0
*@since   1.0.0
*/
class Sample_Plugin_Admin_Db {
	private $table_name;

	/**
	*Constructer
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function __construct() {
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'sample_plugin';
	}

	/**
	*Create main table.
	*
	*@version 1.0.0
	*@since   1.0.0
	*/

	public function create_table () {
		global $wpdb;

		$prepared = $wpdb->prepare( "SHOW TABLES LIKE %s", $this->table_name );
		$is_db_exist = $wpdb->get_var( $prepared );
		$charset_collate = $wpdb->get_charset_collate();

		if ( is_null ( $is_db_exist ) ) {
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$query  = "CREATE TABLE " . $this->table_name . " (";
			$query .="id MEDIUMINT(9) NOT NULL AUTO_INCREMENT PRIMARY KEY,";
			$query .="image_url TEXT NOT NULL,";
			$query .="image_alt TEXT,";
			$query .="link_url TEXT,";
			$query .="open_new_tab TINYINT(1) DEFAULT 0,";
			$query .="insert_element_class TINYTEXT,";
			$query .="insert_element_id TINYTEXT,";
			$query .="how_display TINYTEXT,";
			$query .="filter_category TINYINT(1) DEFAULT 0,";
			$query .="category_id BIGINT(20),";
			$query .="register_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
			$query .="update_date DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',";
			$query .="UNIQUE KEY id(id)";
			$query .=") " . $charset_collate;

			dbDelta( $query );
		}
	}

	/**
	*Insert data.
	*
	*@version 1.0.0
	*@since   1.0.0
	*/
	public function get_list_options() {
		global $wpdb;
		$prepared = ' SELECT * FROM '.$this->table_name . ' ORDER BY update_date DESC ';
		return $wpdb->get_results( $prepared );
	}


	/**
	*Insert Post.
	*
	*@version 1.0.0
	*@since   1.0.0
	*@param    array $post
	*/

	public function insert_options( array $post ){
		global $wpdb;

		$data = array(
			'image_url' => $post['sample-image-url'],
			'image_alt' => $post['sample-image-alt'],
			'link_url' => $post['sample-image-link'],
			'open_new_tab' => isset( $post['sample-image-target'] ) ? 1 : 0,
			'insert_element_class' => $post['sample-element-class'],
			'insert_element_id' => $post['sample-element-id'],
			'how_display' => isset( $post['sample-how-display'] ) ? 1 : 0,
			'filter_category' => isset( $post['sample-filter-category'] ) ? 1 : 0,
			'category_id' => $post['sample-display-category'] ,
			'register_date' => date('Y-m-d H:i:s' ),
			'update_date' => date('Y-m-d H:i:s' )
		);

		$prepared = array(
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s'
		);

		$wpdb->insert( $this->table_name, $data, $prepared );
		return $wpdb->insert_id;
	}


}
