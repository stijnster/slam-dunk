<?php

class SlamDunkContextTest extends \PHPUnit\Framework\TestCase{

	public function testValidContextCreation(){
		$context = new \SlamDunk\Context(_ROOT_PATH);
		$this->assertInstanceOf('\\SlamDunk\\Context', $context);
	}

	public function testInValidContextCreation(){
		$this->expectException(\SlamDunk\Exception::class);
		$context = new \SlamDunk\Context(_ROOT_PATH.DIRECTORY_SEPARATOR.'fake');
		$this->assertInstanceOf('\\SlamDunk\\Context', $context);
	}

}