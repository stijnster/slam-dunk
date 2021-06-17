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

	public static function recursiveDelete(string $directory) : int {
		$count = 0;

		if(static::exists($directory)){
			foreach(Finder::find($directory, [ 'relative' => false ]) as $file){
				if(is_file($file)){
					unlink($file);
					$count++;
				}
				if(is_dir($file)){
					static::remove($file);
					$count++;
				}
			}
		}

		return $count;
	}

	public static function ensure(string $directory){
		if(!static::exists($directory)){
			mkdir($directory, 0777, true);
		}
	}

	public static function remove(string $directory){
		if(static::exists($directory)){
			rmdir($directory);
		}
	}

}