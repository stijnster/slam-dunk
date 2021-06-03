<?php

class SlamDunkArgumentsTest extends \PHPUnit\Framework\TestCase{

	public function testWithoutArguments(){
		$arguments = new \SlamDunk\Arguments();
		$this->assertNull($arguments->getCommand());
		$this->assertEquals('help', $arguments->getTaskName());
		$this->assertEquals('something', $arguments->getTaskName([ 'default' => 'something' ]));
		$this->assertEquals('', $arguments->getRemainingArguments());
		$this->assertEquals('', $arguments->toString());
	}


	public function testWithCommand(){
		$arguments = new \SlamDunk\Arguments([ '/bin/slam-dunk' ]);
		$this->assertEquals('/bin/slam-dunk', $arguments->getCommand());
		$this->assertEquals('help', $arguments->getTaskName());
		$this->assertEquals('', $arguments->getRemainingArguments());
		$this->assertEquals('/bin/slam-dunk', $arguments->toString());
	}

	public function testWithCommandAndTask(){
		$arguments = new \SlamDunk\Arguments([ '/bin/slam-dunk', 'beep' ]);
		$this->assertEquals('/bin/slam-dunk', $arguments->getCommand());
		$this->assertEquals('beep', $arguments->getTaskName());
		$this->assertEquals('', $arguments->getRemainingArguments());
		$this->assertEquals('/bin/slam-dunk beep', $arguments->toString());
	}

	public function testWithCommandTaskAndOtherArguments(){
		$arguments = new \SlamDunk\Arguments([ '/bin/slam-dunk', 'print', 'driver=test', '--print-to-pdf', 'A4' ]);
		$this->assertEquals('/bin/slam-dunk', $arguments->getCommand());
		$this->assertEquals('print', $arguments->getTaskName());
		$this->assertEquals('driver=test --print-to-pdf A4', $arguments->getRemainingArguments());
		$this->assertEquals('/bin/slam-dunk print driver=test --print-to-pdf A4', $arguments->toString());
	}


}