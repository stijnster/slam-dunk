<?php

namespace SlamDunk;

class Task {

	private $_basePath;
	private $_relativeFilePath;
	private $_name;
	private $_runCount = 0;

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
		$this->_completeFilePath = FileSystem\Directory::join([ $this->_basePath, $this->_relativeFilePath ]);

		if(!is_file($this->_completeFilePath)){
			throw new Exception("Task file `{$this->_relativeFilePath}` does not exist in path `{$this->_basePath}`.");
		}
	}

	public function getName(){
		if($this->_name === NULL){
			$this->_name = static::relativeFilePathToTaskName($this->_relativeFilePath);
		}

		return $this->_name;
	}

	public function getRunCount() : int {
		return $this->_runCount;
	}

	public function run(Context $context) : bool {
		require $this->_completeFilePath;
		$this->_runCount++;
		return true;
	}

	public function require(Context $context) : bool {
		if($this->_runCount === 0){
			return $this->run($context);
		}

		return false;
	}

}
