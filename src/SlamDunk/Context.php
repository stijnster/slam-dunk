<?php

namespace SlamDunk;

class Context {

	private $_rootPath;

	public function __construct(string $rootPath, array $arguments = []){
		if(!is_dir($rootPath)){
			throw new Exception("Root path `{$rootPath}` does not exist.");
		}
		$this->_rootPath = $rootPath;
		$this->_arguments = new Arguments($arguments);
	}

}
