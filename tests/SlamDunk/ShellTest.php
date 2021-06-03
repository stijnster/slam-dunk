<?php

class SlamDunkShellTest extends \PHPUnit\Framework\TestCase{

	public function testComposeCommandAndArguments(){
		$this->assertEquals('ls', \SlamDunk\Shell::composeCommandAndArguments('ls'));
		$this->assertEquals('ls one two three', \SlamDunk\Shell::composeCommandAndArguments('ls', [ 'one', 'two', 'three' ]));
	}


}