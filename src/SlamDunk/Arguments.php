<?php

namespace SlamDunk;

class Arguments {

	private $_arguments;

	public function __construct(array $arguments = []){
		$this->_arguments = $arguments;
	}

	public function toString(){
		return trim(implode(' ', $this->_arguments));
	}

	public function getCommand() : ?string {
		return $this->atIndex(0);
	}

	public function getTaskName(array $options = []){
		$settings = array_merge([
			'default' => 'help'
		], $options);

		return $this->atIndex(1, $settings);
	}

	public function atIndex(int $index, array $options = []) : ?string {
		$settings = array_merge([
			'default' => null
		], $options);

		if($index < count($this->_arguments)){
			return $this->_arguments[$index];
		}

		return $settings['default'];
	}

	public function getRemainingArguments() : string {
		return implode(' ', array_slice($this->_arguments, 2));
	}

}
