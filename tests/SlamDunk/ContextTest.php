<?php

class SlamDunkContextTest extends \PHPUnit\Framework\TestCase{

	public function testValidContextCreation(){
		$context = new \SlamDunk\Context(_ROOT_PATH);
		$this->assertInstanceOf('\\SlamDunk\\Context', $context);
		$this->assertInstanceOf('\\SlamDunk\\Arguments', $context->getArguments());
		$this->assertEquals([ _ROOT_PATH.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'tasks' ], $context->getTasksPaths());
		$this->assertEquals([], $context->getTasks());
	}

	public function testInValidContextCreation(){
		$this->expectException(\SlamDunk\Exception::class);
		$context = new \SlamDunk\Context(_ROOT_PATH.DIRECTORY_SEPARATOR.'fake');
		$this->assertInstanceOf('\\SlamDunk\\Context', $context);
	}

}