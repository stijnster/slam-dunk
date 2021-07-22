<?php

namespace SlamDunk;

class Format {

	public static function pluralize(int $count, string $single, string $plural){
		return ($count == 1) ? "{$count} {$single}" : "{$count} {$plural}";
	}

	public static function humanTimeDistance(\DateTime $start, \DateTime $end) : string {
		if($diff = $start->diff($end, true)){
			$output = [];

			if($diff->d > 0){
				array_push($output, static::pluralize($diff->d, 'day', 'days'));
			}
			if($diff->h > 0){
				array_push($output, static::pluralize($diff->h, 'hour', 'hours'));
			}
			if($diff->i > 0){
				array_push($output, static::pluralize($diff->i, 'minute', 'minutes'));
			}
			if($diff->s > 0){
				array_push($output, static::pluralize($diff->s, 'second', 'seconds'));
			}
			if(count($output) === 0){
				array_push($output, static::pluralize(round($diff->f * 1000), 'millisecond', 'milliseconds'));
			}

			if(count($output) > 1){
				array_splice($output, count($output) - 1, 0, 'and');
			}

			return implode(' ', $output);
		}

		return '???';
	}

	public static function fileSize(int $bytes){
		if ($bytes >= 1073741824){
			$result = number_format($bytes / 1073741824, 2) . ' GB';
		}
		elseif ($bytes >= 1048576){
			$result = number_format($bytes / 1048576, 2) . ' MB';
		}
		elseif ($bytes >= 1024){
			$result = number_format($bytes / 1024, 2) . ' KB';
		}
		elseif ($bytes > 1){
			$result = $bytes . ' bytes';
		}
		elseif ($bytes == 1){
			$result = $bytes . ' byte';
		}
		else{
			$result = '0 bytes';
		}

		return $result;
	}

}
