<?php

class SlamDunkTaskTest extends \PHPUnit\Framework\TestCase{

	public function testRelativeFilePathToTaskName(){
		$this->assertEquals('help', \SlamDunk\Task::relativeFilePathToTaskName('help.php'));
		$this->assertEquals('help', \SlamDunk\Task::relativeFilePathToTaskName('/help.php'));
		$this->assertEquals('one', \SlamDunk\Task::relativeFilePathToTaskName('one.php'));
		$this->assertEquals('level:one', \SlamDunk\Task::relativeFilePathToTaskName('Level/One.php'));
		$this->assertEquals('level:deeper:two', \SlamDunk\Task::relativeFilePathToTaskName('level/deeper/Two.php'));
	}

	public function testDescriptions(){
		$task = new \SlamDunk\Task(_TEST_TASKS_PATH, \SlamDunk\FileSystem\Directory::join([ 'one.php' ]));
		$this->assertEquals('one', $task->getName());
		$this->assertEquals('', $task->getShortDescription());
		$this->assertEquals('', $task->getLongDescription());

		$task = new \SlamDunk\Task(_TEST_TASKS_PATH, \SlamDunk\FileSystem\Directory::join([ 'deep', 'one.php' ]));
		$this->assertEquals('deep:one', $task->getName());
		$this->assertEquals('This one only has a short description!', $task->getShortDescription());
		$this->assertEquals('', $task->getLongDescription());

		$task = new \SlamDunk\Task(_TEST_TASKS_PATH, \SlamDunk\FileSystem\Directory::join([ 'deep', 'two.php' ]));
		$this->assertEquals('deep:two', $task->getName());
		$this->assertEquals('This one has a short description!', $task->getShortDescription());
		$this->assertEquals("But is also has a long description.\n", $task->getLongDescription());
	}

}