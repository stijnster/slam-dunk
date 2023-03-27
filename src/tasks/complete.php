<?php

/**
 * Generates a list of matching tasks for bash completion, use `__COMMAND__ help <taskname>`
 */

$command = $context->getArguments()->atIndex(2);


if(\SlamDunk\Validator::isNotPresent($command)){
	$tasks = $context->getTaskNames();
}
else{
	$tasks = $context->getAlternativeTasks($command);
}

foreach($tasks as $task){
	echo "'{$task}' ";
}
exit(0);