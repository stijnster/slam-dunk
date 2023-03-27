<?php

class SlamDunkContextTest extends \PHPUnit\Framework\TestCase{

	public function testValidContextCreation(){
		$context = new \SlamDunk\Context(_ROOT_PATH);
		$this->assertInstanceOf('\\SlamDunk\\Context', $context);
		$this->assertInstanceOf('\\SlamDunk\\Arguments', $context->getArguments());
		$this->assertEquals([ _ROOT_PATH.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'tasks' ], $context->getTasksPaths());
		$this->assertEquals(1, count($context->getTasks()));
		$this->assertTrue(array_key_exists('help', $context->getTasks()));
		$this->assertNull($context->getTaskByName('fake'));
		$this->assertInstanceOf('\\SlamDunk\\Task', $context->getTaskByName('help'));
		$this->assertEquals('help', $context->getTaskByName('help')->getName());
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
		$this->assertEquals(8, count($context->getTasks()));

		$taskNames = array_keys($context->getTasks());
		sort($taskNames);
		$this->assertEquals([ 'deep:all', 'deep:deeper:a', 'deep:one', 'deep:three', 'deep:two', 'empty', 'help', 'one' ], $taskNames);
	}

	public function testRun(){
		$context = new \SlamDunk\Context(_ROOT_PATH);
		$context->appendTasksPath(_TEST_TASKS_PATH);
		$task = $context->getTaskByName('empty');
		$this->assertInstanceOf('\\SlamDunk\\Task', $task);

		$this->assertEquals(0, $task->getRunCount());
		$this->assertTrue($task->run($context));
		$this->assertEquals(1, $task->getRunCount());
		$this->assertTrue($task->run($context));
		$this->assertEquals(2, $task->getRunCount());
	}

	public function testRequire(){
		$context = new \SlamDunk\Context(_ROOT_PATH);
		$context->appendTasksPath(_TEST_TASKS_PATH);
		$task = $context->getTaskByName('empty');
		$this->assertInstanceOf('\\SlamDunk\\Task', $task);

		$this->assertEquals(0, $task->getRunCount());
		$this->assertTrue($task->require($context));
		$this->assertEquals(1, $task->getRunCount());
		$this->assertFalse($task->require($context));
		$this->assertEquals(1, $task->getRunCount());
	}

	public function testSimilarTasks(){
		$context = new \SlamDunk\Context(_ROOT_PATH);
		$context->appendTasksPath(_TEST_TASKS_PATH);
		$task = $context->getTaskByName('deep');
		$this->assertNull($task);

		$this->assertEquals([], $context->getAlternativeTasks('unknown'));
		$this->assertEquals([ 'deep:all', 'deep:three', 'deep:one', 'deep:deeper:a', 'deep:two' ], $context->getAlternativeTasks('deep'));
		$this->assertEquals([ 'deep:all' ], $context->getAlternativeTasks('deep:a'));
		$this->assertEquals([ 'deep:all', 'deep:deeper:a' ], $context->getAlternativeTasks(':a'));
	}

}