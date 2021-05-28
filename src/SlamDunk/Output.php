<?php

namespace SlamDunk;

class Output {

	private static $_streamWriter;

	public static function getStreamWriter(){
		if(static::$_streamWriter === NULL){
			static::$_streamWriter = new \Bramus\Ansi\Ansi(new \Bramus\Ansi\Writers\StreamWriter('php://stdout'));
		}

		return static::$_streamWriter;
	}

	public static function writeLine(string $text){
		static::getStreamWriter()
			->nostyle()
			->text($text)
			->lf();
	}

	public static function emptyLine(int $count = 1){
		for($index = 0; $index < $count; $index++){
			static::getStreamWriter()
				->lf();
		}
	}

	public static function info(string $topic, string $message){
		static::getStreamWriter()
			->color([
				\Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR::COLOR_FG_WHITE,
				\Bramus\Ansi\ControlSequences\EscapeSequences\Enums\SGR::COLOR_BG_BLUE
			])
			->text(str_pad(" {$topic } ", 10, ' ', STR_PAD_BOTH))
			->nostyle()
			->text(" ")
			->text($message)
			->lf();
	}

	public static function bell(){
		static::getStreamWriter()
			->bell();
	}

}