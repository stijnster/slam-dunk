<?php

class SlamDunkFileSystemDirectoryTest extends \PHPUnit\Framework\TestCase{

	public function testCurrentDirectory(){
		chdir(__DIR__);
		$this->assertEquals(__DIR__, \SlamDunk\FileSystem\Directory::getCurrent());
		\SlamDunk\FileSystem\Directory::setCurrent(_ROOT_PATH);
		$this->assertEquals(_ROOT_PATH, getcwd());
		$this->assertEquals(_ROOT_PATH, \SlamDunk\FileSystem\Directory::getCurrent());
	}

	public function testExists(){
		$this->assertTrue(\SlamDunk\FileSystem\Directory::exists(__DIR__));
		$this->assertFalse(\SlamDunk\FileSystem\Directory::exists(__DIR__.DIRECTORY_SEPARATOR.'non-existing'));
	}

	public function testJoin(){
		$this->assertEquals('/one/two/three', \SlamDunk\FileSystem\Directory::join([ 'one', 'two', 'three' ]));
		$this->assertEquals(_ROOT_PATH.DIRECTORY_SEPARATOR.'src', \SlamDunk\FileSystem\Directory::join([ 'src', 'SlamDunk', '..' ], [ 'basePath' => _ROOT_PATH ]));
	}

}