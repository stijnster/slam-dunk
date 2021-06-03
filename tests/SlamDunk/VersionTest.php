<?php

class SlamDunkVersionTest extends \PHPUnit\Framework\TestCase{

	public function testVersion(){
		$this->assertEquals('0.1.0.0', \SlamDunk\Version::getVersion());
		$this->assertEquals(0, \SlamDunk\Version::getMajor());
		$this->assertEquals(1, \SlamDunk\Version::getMinor());
		$this->assertEquals(0, \SlamDunk\Version::getMaintenance());
		$this->assertEquals(0, \SlamDunk\Version::getBuild());
	}

}