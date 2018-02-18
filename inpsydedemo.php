<?php defined( 'ABSPATH' ) or die( 'No direct access allowed' );

/*
Plugin Name: Inpsyde Demo Plugin
Description: This plugin demo wp_nounce
*/

require_once dirname(__FILE__) . '/vendor/autoload.php';

class Inpsydedemo{

	private static $instance;

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

}


if(class_exists('Inpsydedemo')){

	$inpsydedemo = Inpsydedemo::getInstance();

}