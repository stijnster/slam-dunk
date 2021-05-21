<?php

namespace SlamDunk;

class Task {

	private $_basePath;
	private $_relativeFilePath;
	private $_name;

	public static function relativeFilePathToTaskName(string $relativeFilePath) : string {
		$result = strtolower(trim($relativeFilePath));
		$result = preg_replace('/\.php$/', '', $result);
		$result = ltrim($result, '/');
		$result = str_replace(DIRECTORY_SEPARATOR, ':', $result);

		return $result;
	}

	public function __construct($basePath, $relativeFilePath){
		$this->_basePath = rtrim($basePath, '/');
		$this->_relativeFilePath = ltrim($relativeFilePath, '/');
	}

	public function getName(){
		if($this->_name === NULL){
			$this->_name = static::relativeFilePathToTaskName($this->_relativeFilePath);
		}

		return $this->_name;
	}

}
