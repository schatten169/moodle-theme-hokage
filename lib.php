<?php

defined('MOODLE_INTERNAL') || die();

function theme_hokage_get_main_scss_content($theme) {                                                                                
    global $CFG;                                                                                                                    

    $style = file_get_contents($CFG->dirroot . '/theme/hokage/scss/style.scss');
    return $style;
}