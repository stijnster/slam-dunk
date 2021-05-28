<?php
/**
 * This one has a short description!
 *
 * But is also has a long description.
 */

\SlamDunk\Output::verbose('deep:two', 'Verbose from task deep:two');
\SlamDunk\Output::info('deep:two', 'Info from task deep:two');
\SlamDunk\Output::warning('deep:two', 'Warning from task deep:two');
\SlamDunk\Output::error('deep:two', 'Error from task deep:two');
\SlamDunk\Output::success('deep:two', 'Success from task deep:two');
\SlamDunk\Output::writeLine('Direct output');