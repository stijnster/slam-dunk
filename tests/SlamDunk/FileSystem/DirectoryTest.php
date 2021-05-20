<?php

class SlamDunkFileSystemDirectoryTest extends \PHPUnit\Framework\TestCase{

	public function testCurrentDirectory(){
		chdir(__DIR__);
		$this->assertEquals(__DIR__, \SlamDunk\FileSystem\Directory::getCurrent());
		\SlamDunk\FileSystem\Directory::setCurrent(_ROOT_PATH);
		$this->assertEquals(_ROOT_PATH, getcwd());
		$this->assertEquals(_ROOT_PATH, \SlamDunk\FileSystem\Directory::getCurrent());
	}

}