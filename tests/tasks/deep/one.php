<?php

/**
 * This one only has a short description!
 */

$context->require('deep:two');

\SlamDunk\Output::verbose('deep:two', 'You can pluralize words; '.\SlamDunk\Format::pluralize(1, 'value', 'values').', '.\SlamDunk\Format::pluralize(100, 'value', 'values'));
\SlamDunk\Output::verbose('deep:two', "Show an interval; ".\SlamDunk\Format::humanTimeDistance(new \DateTime('2021-05-01 12:00:00'), new \DateTime('2021-05-16 19:00:00')));