<?php

class SlamDunkFileSystemFinderTest extends \PHPUnit\Framework\TestCase{

	public function testFindAllFiles(){
		$results = \SlamDunk\FileSystem\Finder::find(_ROOT_PATH);
		$this->assertGreaterThan(0, count($results));
		$this->assertTrue(in_array('.gitignore', $results));
		$this->assertTrue(in_array('composer.json', $results));
		$this->assertTrue(in_array('tests/SlamDunk/FileSystem/FinderTest.php', $results));
	}

	public function testFindNonRelative(){
		$results = \SlamDunk\FileSystem\Finder::find(_ROOT_PATH, [ 'relative' => false ]);
		$this->assertGreaterThan(0, count($results));
		$this->assertTrue(in_array(_ROOT_PATH.DIRECTORY_SEPARATOR.'.gitignore', $results));
		$this->assertTrue(in_array(_ROOT_PATH.DIRECTORY_SEPARATOR.'composer.json', $results));
		$this->assertTrue(in_array(__FILE__, $results));
	}

	public function testFindFiltered(){
		$results = \SlamDunk\FileSystem\Finder::find(_ROOT_PATH, [ 'regexFilter' => '/\.(php|lock)/' ]);
		$this->assertGreaterThan(0, count($results));
		$this->assertFalse(in_array('.gitignore', $results));
		$this->assertFalse(in_array('composer.json', $results));
		$this->assertTrue(in_array('composer.lock', $results));
		$this->assertTrue(in_array('tests/SlamDunk/FileSystem/FinderTest.php', $results));
	}

}