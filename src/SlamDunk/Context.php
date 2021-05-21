<?php

namespace SlamDunk;

class Context {

	private $_rootPath;
	private $_arguments;
	private $_tasksPath;
	private $_tasks;

	public function __construct(string $rootPath, array $arguments = []){
		if(!is_dir($rootPath)){
			throw new Exception("Root path `{$rootPath}` does not exist.");
		}
		$this->_rootPath = $rootPath;
		$this->_arguments = new Arguments($arguments);
		$this->_tasksPaths = [];

		$this->appendTaskPath(FileSystem\Directory::join([ 'tasks' ], [ 'basePath' => __DIR__.DIRECTORY_SEPARATOR.'..' ]));
	}

	public function getArguments() : Arguments {
		return $this->_arguments;
	}

	public function appendTaskPath(string $path){
		if(FileSystem\Directory::exists($path)){
			array_push($this->_tasksPaths, $path);
		}
	}

	public function getTasksPaths() : array {
		return $this->_tasksPaths;
	}

	public function getTasks(){
		if($this->_tasks === NULL){
			$this->_tasks = [];
		}

		return $this->_tasks;
	}

}
