<?php

/**
 * Get detailed help about a task, use `__COMMAND__ help <taskname>`
 */

$command = $context->getArguments()->atIndex(2);

function replacePlaceholders(\SlamDunk\Context $context, string $text) : string {
	return str_replace('__TASK__', (string)$context->getArguments()->atIndex(2), str_replace('__COMMAND__', (string)$context->getArguments()->getCommand(), $text));
}

if($command === null){
	\SlamDunk\Output::writeLine("Here is an overview of the tasks that I can perform:");
	\SlamDunk\Output::emptyLine();

	$longest = 0;
	foreach($context->getTasks() as $task){
		$longest = max([ $longest, strlen($task->getName())]);
	}

	foreach($context->getTasks() as $task){
		\SlamDunk\Output::writeLine("\t".sprintf("%-{$longest}s", $task->getName())."\t".replacePlaceholders($context, $task->getShortDescription()));
	}
}
else{
	if($task = $context->getTaskByName($command)){
		\SlamDunk\Output::writeLine($context->getArguments()->getCommand().' '.$task->getName());
		\SlamDunk\Output::emptyLine();
		\SlamDunk\Output::writeLine("\t".replacePlaceholders($context, $task->getShortDescription()));
		if(strlen(trim($task->getLongDescription())) > 0){
			\SlamDunk\Output::emptyLine();
			foreach(explode("\n", trim($task->getLongDescription())) as $line){
				\SlamDunk\Output::writeLine("\t".replacePlaceholders($context, $line));
			}
		}
	}
	else{
		\SlamDunk\Output::writeLine("Unknown command: {$command}");
	}
}
