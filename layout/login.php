<?php

$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT
];

echo $OUTPUT->render_from_template('theme_hokage/login', $templatecontext);

