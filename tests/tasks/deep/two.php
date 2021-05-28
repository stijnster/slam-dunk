<?php

define('_TOPIC', 'deep:two');

/**
 * This one has a short description!
 *
 * But is also has a long description.
 */

\SlamDunk\Output::verbose(_TOPIC, 'Verbose from task deep:two');
\SlamDunk\Output::info(_TOPIC, 'Info from task deep:two');
\SlamDunk\Output::warning(_TOPIC, 'Warning from task deep:two');
\SlamDunk\Output::error(_TOPIC, 'Error from task deep:two');
\SlamDunk\Output::success(_TOPIC, 'Success from task deep:two');
\SlamDunk\Output::writeLine('Direct output');