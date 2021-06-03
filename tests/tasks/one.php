<?php

SlamDunk\Output::info('one', 'Capturing console and formatting line by line');
SlamDunk\Output::emptyLine();
$output = SlamDunk\Shell::capture('ls', [ '-alh' ]);
$lines = explode("\n", trim($output));
foreach($lines as $line){
	SlamDunk\Output::verbose('ls -alh', $line);
}
SlamDunk\Output::emptyLine();
SlamDunk\Output::info('one', 'Streaming console');
SlamDunk\Shell::stream('ls', [ '-alh' ]);
