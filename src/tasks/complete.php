<?php

/**
 * Generates a list of matching tasks for bash completion, use `__COMMAND__ help <taskname>`
 */

$command = $context->getArguments()->atIndex(2);


if(\SlamDunk\Validator::isNotPresent($command)){
	echo "";
	exit(0);
}

$alternativeTasks = $context->getAlternativeTasks($command);
foreach($alternativeTasks as $task){
	echo "'{$task}' ";
}
exit(0);