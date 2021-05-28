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

}
