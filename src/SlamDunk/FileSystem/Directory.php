<?php
namespace SlamDunk\FileSystem;

class Directory {

	public static function getCurrent(){
		return getcwd();
	}

	public static function setCurrent(string $directory) : bool {
		return chdir($directory);
	}

}