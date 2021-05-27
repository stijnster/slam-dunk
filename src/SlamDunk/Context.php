<?php

namespace SlamDunk;

class Context {

	const TASK_FILE_NAME_REGEX = '/[a-z_-]+\.php$/';

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

		$this->appendTasksPath(FileSystem\Directory::join([ 'tasks' ], [ 'basePath' => __DIR__.DIRECTORY_SEPARATOR.'..' ]));
	}

	public function getArguments() : Arguments {
		return $this->_arguments;
	}

	public function appendTasksPath(string $path){
		if(FileSystem\Directory::exists($path)){
			$this->_tasks = NULL;
			array_push($this->_tasksPaths, $path);
		}
	}

	public function getTasksPaths() : array {
		return $this->_tasksPaths;
	}

	public function getTasks(){
		if($this->_tasks === NULL){
			$this->_tasks = [];
			foreach($this->_tasksPaths as $basePath){
				$relativeFiles = FileSystem\Finder::find($basePath, [ 'regexFilter' => static::TASK_FILE_NAME_REGEX ]);
				foreach($relativeFiles as $relativeFile){
					$task = new Task($basePath, $relativeFile);
					$this->_tasks[$task->getName()] = $task;
				}
			}
		}

		return $this->_tasks;
	}

	public function getTask(string $taskName) : ?Task {
		if(array_key_exists($taskName, $this->getTasks())){
			return $this->getTasks()[$taskName];
		}

		return null;
	}

	public function run(array $options = []){
		if($task = $this->getTask($this->getArguments()->getTaskName())){
			$task->run($this);
		}
	}

}
