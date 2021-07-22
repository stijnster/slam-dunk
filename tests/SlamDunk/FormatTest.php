<?php

class SlamDunkFormatTest extends \PHPUnit\Framework\TestCase{

	public function testPluralize(){
		$this->assertEquals('0 tasks', \SlamDunk\Format::pluralize(0, 'task', 'tasks'));
		$this->assertEquals('1 task', \SlamDunk\Format::pluralize(1, 'task', 'tasks'));
		$this->assertEquals('876 tasks', \SlamDunk\Format::pluralize(876, 'task', 'tasks'));
	}

	public function testHumanTimeDistance(){
		$this->assertEquals('2 seconds', \SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-27 19:01:01.000000'), new \DateTime('2021-05-27 19:01:03.000000')));
		$this->assertEquals('2 seconds', \SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-27 19:01:03.000000'), new \DateTime('2021-05-27 19:01:01.000000')));
		$this->assertEquals('864 milliseconds', \SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-27 19:01:01.123456'), new \DateTime('2021-05-27 19:01:01.987654')));
		$this->assertEquals('15 minutes and 21 seconds', \SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-27 19:01:01.123456'), new \DateTime('2021-05-27 19:16:22.987654')));
		$this->assertEquals('15 minutes', \SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-27 19:01:01.123456'), new \DateTime('2021-05-27 19:16:01.123456')));
		$this->assertEquals('14 minutes and 59 seconds', \SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-27 19:01:01.123456'), new \DateTime('2021-05-27 19:16:00.123456')));
		$this->assertEquals('1 hour 14 minutes and 59 seconds', \SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-27 18:01:01.123456'), new \DateTime('2021-05-27 19:16:00.123456')));
		$this->assertEquals('3 days 1 hour 14 minutes and 59 seconds', \SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-24 18:01:01.123456'), new \DateTime('2021-05-27 19:16:00.123456')));
	}

	public function testFileSize(){
		$this->assertEquals('0 bytes', \SlamDunk\Format::fileSize(0));
		$this->assertEquals('1023 bytes', \SlamDunk\Format::fileSize(1023));
		$this->assertEquals('1.00 KB', \SlamDunk\Format::fileSize(1024));
		$this->assertEquals('3.01 GB', \SlamDunk\Format::fileSize(1024 * 1024 * 1024 * 3 + 12434857));
	}


}