<?php

class SlamDunkTaskTest extends \PHPUnit\Framework\TestCase{

	public function testRelativeFilePathToTaskName(){
		$this->assertEquals('help', \SlamDunk\Task::relativeFilePathToTaskName('help.php'));
		$this->assertEquals('help', \SlamDunk\Task::relativeFilePathToTaskName('/help.php'));
		$this->assertEquals('one', \SlamDunk\Task::relativeFilePathToTaskName('one.php'));
		$this->assertEquals('level:one', \SlamDunk\Task::relativeFilePathToTaskName('Level/One.php'));
		$this->assertEquals('level:deeper:two', \SlamDunk\Task::relativeFilePathToTaskName('level/deeper/Two.php'));
	}

}