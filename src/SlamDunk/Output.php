<?php

namespace SlamDunk;

class Output {

	public static function writeLine(string $message){
		echo "{$message}\n";
	}

	public static function emptyLine(int $count = 1){
		for($index = 0; $index < $count; $index++){
			static::writeLine('');
		}
	}

}