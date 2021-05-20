<?php

namespace SlamDunk;

class Arguments {

	private $_arguments;

	public function __construct(array $arguments = []){
		$this->_arguments = $arguments;
	}

	public function getCommand() : ?string {
		if(count($this->_arguments) > 0){
			return $this->_arguments[0];
		}

		return null;
	}

	public function getTask(array $options = []){
		$settings = array_merge([
			'default' => 'help'
		], $options);

		if(count($this->_arguments) > 0){
			return $this->_arguments[0];
		}

		return $settings['default'];
	}

	public function getRemainingArguments() : string {
		return implode(' ', array_slice(static::$_arguments, 2));
	}

}
