<?php

namespace SlamDunk;

class Shell {

	public static function capture(string $command, ?array $arguments = []) : string {
		return shell_exec(static::composeCommandAndArguments($command, $arguments));
	}

	public static function stream(string $command, ?array $arguments = []){
		passthru(static::composeCommandAndArguments($command, $arguments));
	}

	public static function composeCommandAndArguments(string $command, ?array $arguments = []) : string {
		$composed = trim($command.' '.implode(' ', $arguments));

		return $composed;
	}

}