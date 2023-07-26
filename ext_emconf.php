<?php

/**
 * Extension Manager/Repository config file for ext "demo_sitepackage".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Demo Sitepackage',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
            'fluid_styled_content' => '11.5.0-11.5.99',
            'rte_ckeditor' => '11.5.0-11.5.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Mbigha\\DemoSitepackage\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Sigala Mbigha',
    'author_email' => 'sigalambigha@gmail.com',
    'author_company' => 'Mbigha',
    'version' => '1.0.0',
];
