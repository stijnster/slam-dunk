<?php

class SlamDunkValidatorTest extends \PHPUnit\Framework\TestCase{

	public function testIsPresent(){
		$this->assertFalse(\SlamDunk\Validator::isPresent(NULL));
		$this->assertFalse(\SlamDunk\Validator::isPresent(''));
		$this->assertFalse(\SlamDunk\Validator::isPresent(' '));

		$this->assertTrue(\SlamDunk\Validator::isPresent('Stijn'));

		$this->assertFalse(\SlamDunk\Validator::isPresent([]));

		$this->assertTrue(\SlamDunk\Validator::isPresent([ 1, 2, 3 ]));
		$this->assertTrue(\SlamDunk\Validator::isPresent([ 'a' => 'b' ]));

		$this->assertTrue(\SlamDunk\Validator::isPresent(0));
		$this->assertTrue(\SlamDunk\Validator::isPresent(1));
		$this->assertTrue(\SlamDunk\Validator::isPresent(-1));

		$this->assertTrue(\SlamDunk\Validator::isPresent(0.0));
		$this->assertTrue(\SlamDunk\Validator::isPresent(9500.33));
		$this->assertTrue(\SlamDunk\Validator::isPresent(-2910.293));

		$this->assertTrue(\SlamDunk\Validator::isPresent(new \DateTime()));
	}

}