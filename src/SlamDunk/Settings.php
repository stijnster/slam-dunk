<?php

namespace SlamDunk;

class Settings {

	private static $_cached = [];
	private static $_map = [];

	public static function clear(){
		static::$_cached = [];
		static::$_map = [];
	}

	public static function set($key, $value){
		static::$_cached = [];
		static::$_map[$key] = $value;
	}

	public static function get(string $key, array $options = []){
		$settings = array_merge([
			'default' => null
			], $options);

		if(array_key_exists($key, static::$_cached)){
			return static::$_cached[$key];
		}

		$parts = explode('.', $key);
		$collection = static::$_map;
		for($index = 0; $index < count($parts); $index++){
			$part = $parts[$index];
			if(array_key_exists($part, $collection)){
				if(is_array($collection[$part])){
					$collection = $collection[$part];

					if($index === (count($parts) - 1)){
						return $collection;
					}
				}
				else{
					static::$_cached[$key] = $collection[$part];
					return $collection[$part];
				}
			}
		}

		return $settings['default'];
	}

}