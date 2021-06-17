<?php

namespace SlamDunk;

class Shell {

	public static function capture(string $command, array $arguments = []) : string {
		return shell_exec(static::composeCommandAndArguments($command, $arguments));
	}

	public static function stream(string $command, array $arguments = []){
		passthru(static::composeCommandAndArguments($command, $arguments));
	}

	public static function exec(string $command, array $arguments = [], array $options = []) : int {
		$settings = array_merge([
			'silent' => true
		], $options);

		if($settings['silent']){
			array_push($arguments, '2> /dev/null');
		}

		exec(static::composeCommandAndArguments($command, $arguments), $output, $result);

		return $result;
	}

	public static function composeCommandAndArguments(string $command, array $arguments = []) : string {
		$composed = trim($command.' '.implode(' ', $arguments));

		return $composed;
	}

}