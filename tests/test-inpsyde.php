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

	function test_class_singleton(){
		$inpsydedemo1 = Inpsydedemo::getInstance();
		$inpsydedemo2 = Inpsydedemo::getInstance();

		$this->assertSame($inpsydedemo1,$inpsydedemo2);
	}


	function test_form(){
		$inpsydedemo = Inpsydedemo::getInstance();	
		$form = $inpsydedemo->inpsyde_form();

		$this->assertContains('</form>',$form);
	}


	function test_nonce_with_form(){
		$inpsydedemo = Inpsydedemo::getInstance();
		$form = $inpsydedemo->inpsyde_form();
		$this->assertNotContains('<input type="hidden" name="inpsyde_form_nonce" value=""/>',$form);
	}
}
