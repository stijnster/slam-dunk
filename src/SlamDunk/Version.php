<?php

namespace SlamDunk;

class Version {

	private static $version = [
		'major' => 0,
		'minor' => 0,
		'maintenance' => 0,
		'build' => 0
	];

	public static function getVersion(){
		return implode('.', self::$version);
	}

	public static function getMajor(){
		return self::$version['major'];
	}

	public static function getMinor(){
		return self::$version['minor'];
	}

	public static function getMaintenance(){
		return self::$version['maintenance'];
	}

	public static function getBuild(){
		return self::$version['build'];
	}

}