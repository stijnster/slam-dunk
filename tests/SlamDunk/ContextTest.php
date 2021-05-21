<?php

class SlamDunkContextTest extends \PHPUnit\Framework\TestCase{

	public function testValidContextCreation(){
		$context = new \SlamDunk\Context(_ROOT_PATH);
		$this->assertInstanceOf('\\SlamDunk\\Context', $context);
		$this->assertInstanceOf('\\SlamDunk\\Arguments', $context->getArguments());
		$this->assertEquals([ _ROOT_PATH.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'tasks' ], $context->getTasksPaths());
		$this->assertEquals(1, count($context->getTasks()));
		$this->assertTrue(array_key_exists('help', $context->getTasks()));
		$this->assertNull($context->getTask('fake'));
		$this->assertInstanceOf('\\SlamDunk\\Task', $context->getTask('help'));
		$this->assertEquals('help', $context->getTask('help')->getName());
	}

	public function testInValidContextCreation(){
		$this->expectException(\SlamDunk\Exception::class);
		$context = new \SlamDunk\Context(_ROOT_PATH.DIRECTORY_SEPARATOR.'fake');
		$this->assertInstanceOf('\\SlamDunk\\Context', $context);
	}

	public function testTaskPaths(){
		$context = new \SlamDunk\Context(_ROOT_PATH);
		$this->assertEquals(1, count($context->getTasksPaths()));
		$this->assertEquals(1, count($context->getTasks()));

		$context->appendTasksPath(_ROOT_PATH.'fake');
		$this->assertEquals(1, count($context->getTasksPaths()));
		$this->assertEquals(1, count($context->getTasks()));

		$this->assertTrue(\SlamDunk\FileSystem\Directory::exists(_TEST_TASKS_PATH));
		$context->appendTasksPath(_TEST_TASKS_PATH);
		$this->assertEquals(2, count($context->getTasksPaths()));
		$this->assertGreaterThan(1, count($context->getTasks()));
		$this->assertEquals(6, count($context->getTasks()));
	}

}