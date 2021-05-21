<?php
namespace SlamDunk\FileSystem;

class Finder {

	public static function find(string $basePath, array $options = []) : array {
		$settings = array_merge([
			'regexFilter' => NULL,
			'relative' => true
		], $options);

		$results = [];
		if(Directory::exists($basePath)){
			$iterator = new \RecursiveDirectoryIterator($basePath, \RecursiveDirectoryIterator::SKIP_DOTS);
			$iterator = new \RecursiveIteratorIterator($iterator);
			if($settings['regexFilter'] !== NULL){
				$iterator = new \RegexIterator($iterator, $settings['regexFilter'], \RecursiveRegexIterator::GET_MATCH);
			}
			foreach($iterator as $filePath => $_){
				if($settings['relative']){
					$filePath = ltrim(str_replace($basePath, '', $filePath), DIRECTORY_SEPARATOR);
				}
				array_push($results, $filePath);
			}
		}

		return $results;
	}

}