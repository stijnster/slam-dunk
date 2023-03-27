<?php

namespace SlamDunk;

class Validator{

	public static function isNotPresent($value) : bool {
		return (!(static::isPresent($value)));
	}

	public static function isPresent($value) : bool {
		if($value === NULL){
			return FALSE;
		}

		if(is_string($value)){
			return (strlen(trim($value)) > 0);
		}

		if(is_array($value)){
			return (count($value) > 0);
		}

		return TRUE;
	}

}