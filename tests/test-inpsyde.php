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
}
