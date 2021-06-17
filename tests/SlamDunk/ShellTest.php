<?php

class SlamDunkShellTest extends \PHPUnit\Framework\TestCase{

	public function testComposeCommandAndArguments(){
		$this->assertEquals('ls', \SlamDunk\Shell::composeCommandAndArguments('ls'));
		$this->assertEquals('ls one two three', \SlamDunk\Shell::composeCommandAndArguments('ls', [ 'one', 'two', 'three' ]));
	}

	public function testExec(){
		$this->assertEquals(0, \SlamDunk\Shell::exec('ls', [ '-alh' ]));
		$this->assertNotEquals(0, \SlamDunk\Shell::exec('some-fake-command'));
	}


}