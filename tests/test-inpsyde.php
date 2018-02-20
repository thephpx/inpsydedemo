<?php
/**
 * Inpsyde test case.
 */
class InpsydeTest extends WP_UnitTestCase {

	/**
	 * Cclass load test.
	 */
	function test_class_loaded() {
		// Replace this with some actual testing code.
		$inpsydedemo = Inpsydedemo::getInstance();

		$this->assertInstanceOf('Inpsydedemo',$inpsydedemo);
	}


	function test_form(){
		$inpsydedemo = Inpsydedemo::getInstance();	
		$form = $inpsydedemo->inpsyde_form();

		$this->assertContains('</form>',$form);
	}


	function test_nonce_with_form(){
		$inpsydedemo = Inpsydedemo::getInstance();	

		$reflection = new \ReflectionClass('Inpsydedemo');
		$method = $reflection->getMethod('get_wp_nonce');
		$method->setAccessible(true);
		
		$nonce = $method->invokeArgs($inpsydedemo, array('inpsyde_form_nonce'));

		$this->assertNotEmpty($nonce);

		$form = $inpsydedemo->inpsyde_form();
		$this->assertContains($nonce,$form);
	}
}
