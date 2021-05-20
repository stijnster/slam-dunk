<?php

namespace SlamDunk;

class Context {

	private $_rootPath;
	private $_arguments;
	private $_tasks;

	public function __construct(string $rootPath, array $arguments = []){
		if(!is_dir($rootPath)){
			throw new Exception("Root path `{$rootPath}` does not exist.");
		}
		$this->_rootPath = $rootPath;
		$this->_arguments = new Arguments($arguments);
		$this->_tasks = [];
	}

	public function getArguments() : Arguments {
		return $this->_arguments;
	}

	public function getTasks() : array {
		return $this->_tasks;
	}

}
