<?php

namespace SlamDunk;

class Task {

	private $_basePath;
	private $_relativeFilePath;
	private $_name;
	private $_shortDescription;
	private $_longDescription;
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

	public function getShortDescription() : string {
		if($this->_shortDescription === NULL){
			$this->_extractDescriptions();
		}

		return $this->_shortDescription;
	}

	public function getLongDescription() : string {
		if($this->_longDescription === NULL){
			$this->_extractDescriptions();
		}

		return $this->_longDescription;
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

	private function _extractDescriptions(){
		$this->_shortDescription = '';
		$this->_longDescription = '';

		$contents = file_get_contents($this->_completeFilePath);

		$start = false;
		$end = false;
		$firstEmptyLineDetected = false;
		foreach(explode("\n", $contents) as $line){
			if(preg_match('/\*\//', $line)){
				$end = true;
			}
			if($start && !$end){
				if(preg_match('/^\s?\*\s?(.*)/', $line, $matches)){
					if(strlen(trim($this->_shortDescription)) === 0){
						$this->_shortDescription = $matches[1];
					}
					else{
						if($firstEmptyLineDetected){
							$this->_longDescription .= $matches[1]."\n";
						}
					}
					if(strlen(trim($matches[1])) === 0){
						$firstEmptyLineDetected = true;
					}
				}
			}
			if(preg_match('/\/\*\*/', $line)){
				$start = true;
			}
		}
	}

}
