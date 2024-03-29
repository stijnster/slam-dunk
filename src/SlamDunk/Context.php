<?php

namespace SlamDunk;

class Context {

	const TASK_FILE_NAME_REGEX = '/[a-z_-]+\.php$/';
	const TOPIC = 'main';

	private $_rootPath;
	private $_arguments;
	private $_tasksPaths;
	private $_tasks;
	private $_silent = false;

	public function __construct(string $rootPath, array $arguments = []){
		if(!is_dir($rootPath)){
			throw new Exception("Root path `{$rootPath}` does not exist.");
		}
		$this->_rootPath = $rootPath;
		$this->_arguments = new Arguments($arguments);
		$this->_tasksPaths = [];

		$this->appendTasksPath(FileSystem\Directory::join([ 'tasks' ], [ 'basePath' => __DIR__.DIRECTORY_SEPARATOR.'..' ]));
	}

	public function isSilent() : bool {
		return $this->_silent;
	}

	public function setSilent(bool $silent){
		$this->_silent = $silent;
	}

	public function getRootPath() : string {
		return $this->_rootPath;
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

	public function getTasks() : array {
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

	public function getTaskNames() : array {
		return array_keys($this->getTasks());
	}

	public function getTaskByName(string $taskName) : ?Task {
		if(array_key_exists($taskName, $this->getTasks())){
			return $this->getTasks()[$taskName];
		}

		return null;
	}

	public function getAlternativeTasks(string $taskName) : array {
		$result = [];

		foreach($this->getTaskNames() as $existingTask){
			if(strpos($existingTask, $taskName) !== FALSE){
				array_push($result, $existingTask);
			}
		}

		sort($result);

		return array_values($result);
	}

	public function printAlternativeTasks(string $taskName){
		$alternativeTasks = $this->getAlternativeTasks($taskName);

		if(count($alternativeTasks) === 0){
			return;
		}

		Output::emptyLine();
		Output::writeLine("But how about:");
		Output::emptyLine();
		foreach($alternativeTasks as $alternativeTask){
			Output::writeLine("\t{$alternativeTask}");
		}
		Output::emptyLine();
	}

	public function require($tasksNames){
		if(!is_array($tasksNames)){
			$tasksNames = [ $tasksNames ];
		}

		foreach($tasksNames as $taskName){
			if($task = $this->getTaskByName($taskName)){
				$task->require($this);
			}
			else{
				Output::error(static::TOPIC, "Cannot require task with name `{$taskName}`");
				exit(1);
			}
		}
	}

	public function run(array $options = []){
		$start = new \DateTime();
		if($task = $this->getTaskByName($this->getArguments()->getTaskName())){
			$task->run($this);
		}
		else{
			Output::error(static::TOPIC, 'Cannot find task with name `'.$this->getArguments()->getTaskName().'`');
			$this->printAlternativeTasks($this->getArguments()->getTaskName());
			exit(1);
		}
		$end = new \DateTime();

		if(!$this->isSilent()){
			Output::emptyLine();
			Output::info(static::TOPIC, 'Completed '.Format::pluralize($this->getRunCount(), 'task', 'tasks').' in '.Format::humanTimeDistance($start, $end));
			Output::bell();
		}
	}

	public function getRunCount() : int {
		$count = 0;
		foreach($this->getTasks() as $task){
			$count += $task->getRunCount();
		}

		return $count;
	}

}
