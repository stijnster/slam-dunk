<?php

/**
 * An example on how to require multiple tasks
 */

$context->require(['deep:one', 'deep:two', 'deep:three' ]);

\SlamDunk\Output::success('deep:all', 'Completed running of multiple tasks through require');