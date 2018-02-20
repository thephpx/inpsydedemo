<?php defined( 'ABSPATH' ) or die( 'No direct access allowed' );

/*
Plugin Name: Inpsyde Demo Plugin
Description: This plugin demo wp_nounce
*/

require_once dirname(__FILE__) . '/vendor/autoload.php';

global $wpdb;

class Inpsydedemo{

	private static $instance;

	private $db;

	private function __construct()
	{

	}

	private function __sleep(){

	}

	private function __wakeup(){
		
	}

	private function __clone(){
		
	}

	public static function getInstance()
	{
	  if (!isset(static::$instance))
	  {
	      static::$instance = new static();
	  }
	  return static::$instance;

	}

	public function setDependency($type,&$bject){
		$this->{$type} = $object;
	}

	public function initialize(){
		add_action('init', array($this, 'setup'));
	}

	public function setup(){
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		add_shortcode('inpsyde_form', array($this,'inpsyde_form'));
		add_action('admin_post_inpsyde_form_action', array($this, 'inpsyde_form_action_do'));
		add_action('admin_post_nopriv_inpsyde_form_action', array($this, 'inpsyde_form_action_do'));
		$this->register_inpsyde_post_type();
	}

	public function inpsyde_form_action_do(){
		if(isset($_POST['inpsyde_form_nonce']) AND wp_verify_nonce( $_POST['inpsyde_form_nonce'], 'inpsyde_form_nonce')){
			echo('it');
		}
	}

	private function render($file,&$data){
		ob_start();
		include_once(__DIR__.$file);
		$template_html = ob_get_contents();
		ob_end_clean();
		return $template_html;
	}

	private function get_wp_nonce($name=""){
		return wp_create_nonce($name);
	}

	public function inpsyde_form(){
		$data = array();
		$data['inpsyde_form_nonce'] = $this->get_wp_nonce('inpsyde_form_nonce');
		$data['inpsyde_form_action'] = 'inpsyde_form_action';

		return $this->render('/templates/form.php',$data);
	}

	private function register_inpsyde_post_type(){
		$labels = array(
			"name" => _x("Inpsydes","Inpsyde"),
			"singular_name" => _x("Inpsyde","Inpsyde"),
			"add_new" => _x("Add Inpsyde","Inpsyde"),
			"add_new_item" => _x("Add New Inpsyde","Inpsyde"),
			"edit_item" => _x("Edit Inpsyde","Inpsyde"),
			"new_item" => _x("New Inpsyde","Inpsyde"),
			"view_item" => _x("View Inpsyde","Inpsyde"),
			"search_item" => _x("Search Inpsyde","Inpsyde"),
			"not_found" => _x("Not found","Inpsyde"),
			"not_found_in_trash" => _x("Not found in trash","Inpsyde"),
			"menu_name" => _x("Inpsyde","Inpsyde"),
		);

		$args = array(
			"labels" => $labels,
			"supports" => array("title","editor","custom-fields"),
			"taxonomies" => array('category','post_tag'),
			"public" => true,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"publicly_queryable" => true,
			"has_archive" => true,
			"query_var" => true,
			"rewrite" => array("slug"=>"Inpsyde"),
			"capability_type" => "post"
		);

		register_post_type("Inpsyde", $args);
	}

	public function activate(){

		flush_rewrite_rules();
	}

	public function deactivate(){
		
	}

}

if(class_exists('Inpsydedemo')){
	$inpsydedemo = Inpsydedemo::getInstance();
	$inpsydedemo->setDependency('db', $wpdb);
	$inpsydedemo->initialize();

}