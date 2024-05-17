<?php

defined('MOODLE_INTERNAL') || die();

$THEME->name = 'hokage';                                                                                                             
$THEME->sheets = [];                                                                                                                
$THEME->editor_sheets = [];                                                                                                         
$THEME->parents = ['boost'];                                                                                                        
$THEME->enable_dock = false;
$THEME->yuicssmodules = [];
$THEME->rendererfactory = 'theme_overridden_renderer_factory';                                                                     
$THEME->requiredblocks = '';   
$THEME->addblockposition = BLOCK_ADDBLOCK_POSITION_FLATNAV;
$THEME->haseditswitch = false;

$THEME->scss = function($theme) {
     return theme_hokage_get_main_scss_content($theme);
};

$THEME->layouts = [
    // // Most backwards compatible layout without the blocks.
    // 'base' => array(
    //     'file' => 'drawers.php',
    //     'regions' => array(),
    // ),
    // // Standard layout with blocks.
    // 'standard' => array(
    //     'file' => 'drawers.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    // ),
    // // Main course page.
    // 'course' => array(
    //     'file' => 'drawers.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    //     'options' => array('langmenu' => true),
    // ),
    // 'coursecategory' => array(
    //     'file' => 'drawers.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    // ),
    // // Part of course, typical for modules - default page layout if $cm specified in require_login().
    // 'incourse' => array(
    //     'file' => 'drawers.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    // ),
    // // The site home page.
    // 'frontpage' => array(
    //     'file' => 'frontpage.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    //     'options' => array('nonavbar' => true),
    // ),
    // // Server administration scripts.
    // 'admin' => array(
    //     'file' => 'drawers.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    // ),
    // // My courses page.
    // 'mycourses' => array(
    //     'file' => 'drawers.php',
    //     'regions' => ['side-pre'],
    //     'defaultregion' => 'side-pre',
    //     'options' => array('nonavbar' => true),
    // ),
    // // My dashboard page.
    // 'mydashboard' => [
    //     'file' => 'mydashboard.php',
    //     'regions' => ['side-pre', 'side-admin'],
    //     'defaultregion' => 'side-pre',
    //     'options' => ['nonavbar' => true, 'langmenu' => true, 'nocontextheader' => true],
    // ],
    // // My public page.
    // 'mypublic' => array(
    //     'file' => 'drawers.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    // ),
    // 'login' => array(
    //     'file' => 'login.php',
    //     'regions' => array(),
    //     'options' => array('langmenu' => true),
    // ),

    // // Pages that appear in pop-up windows - no navigation, no blocks, no header and bare activity header.
    // 'popup' => array(
    //     'file' => 'columns1.php',
    //     'regions' => array(),
    //     'options' => array(
    //         'nofooter' => true,
    //         'nonavbar' => true,
    //         'activityheader' => [
    //             'notitle' => true,
    //             'nocompletion' => true,
    //             'nodescription' => true
    //         ]
    //     )
    // ),
    // // No blocks and minimal footer - used for legacy frame layouts only!
    // 'frametop' => array(
    //     'file' => 'columns1.php',
    //     'regions' => array(),
    //     'options' => array(
    //         'nofooter' => true,
    //         'nocoursefooter' => true,
    //         'activityheader' => [
    //             'nocompletion' => true
    //         ]
    //     ),
    // ),
    // // Embeded pages, like iframe/object embeded in moodleform - it needs as much space as possible.
    // 'embedded' => array(
    //     'file' => 'embedded.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    // ),
    // // Used during upgrade and install, and for the 'This site is undergoing maintenance' message.
    // // This must not have any blocks, links, or API calls that would lead to database or cache interaction.
    // // Please be extremely careful if you are modifying this layout.
    // 'maintenance' => array(
    //     'file' => 'maintenance.php',
    //     'regions' => array(),
    // ),
    // // Should display the content and basic headers only.
    // 'print' => array(
    //     'file' => 'columns1.php',
    //     'regions' => array(),
    //     'options' => array('nofooter' => true, 'nonavbar' => false, 'noactivityheader' => true),
    // ),
    // // The pagelayout used when a redirection is occuring.
    // 'redirect' => array(
    //     'file' => 'embedded.php',
    //     'regions' => array(),
    // ),
    // // The pagelayout used for reports.
    // 'report' => array(
    //     'file' => 'drawers.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre',
    // ),
    // // The pagelayout used for safebrowser and securewindow.
    // 'secure' => array(
    //     'file' => 'secure.php',
    //     'regions' => array('side-pre'),
    //     'defaultregion' => 'side-pre'
    // )
];