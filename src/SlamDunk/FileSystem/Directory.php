<?php
namespace SlamDunk\FileSystem;

class Directory {

	public static function getCurrent(){
		return getcwd();
	}

	public static function setCurrent(string $directory) : bool {
		return chdir($directory);
	}

	public static function exists(string $directory) : bool {
		return is_dir($directory);
	}

	public static function join(array $components, array $options = []) : ?string {
		$settings = array_merge([
			'basePath' => NULL
		], $options);

		array_unshift($components, $settings['basePath']);
		$combinedPath = implode(DIRECTORY_SEPARATOR, $components);
		if(static::exists($combinedPath)){
			$combinedPath = realpath($combinedPath);
		}

		return $combinedPath;
	}

}