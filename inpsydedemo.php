<?php defined( 'ABSPATH' ) or die( 'No direct access allowed' );

/*
Plugin Name: Inpsyde Demo Plugin
Description: This plugin demo wp_nounce
*/

require_once dirname(__FILE__) . '/vendor/autoload.php';

global $wpdb;

use App\Utility;
use App\Validation;
use App\Form;

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
		register_activation_hook( __FILE__, array( 'Inpsydedemo', 'activate' ) );
		register_deactivation_hook( __FILE__, array( 'Inpsydedemo', 'deactivate' ) );
	}

	public function activate(){
		$args = array(
	      'public' => true,
	      'label'  => 'inpsyde'
	    );
		register_post_type( 'inpsyde', $args );
	}

	public function deactivate(){
		
	}

}


if(class_exists('Inpsydedemo')){

	


	$inpsydedemo = Inpsydedemo::getInstance();
	$inpsydedemo->setDependency('db', $wpdb);
	$inpsydedemo->initialize();

}