<?php

/**
 * Metadata version
 */
$sMetadataVersion = '2.1';

/**
 * Module information
 */
$aModule = [
    'id'           => 'mke-monolog-prettifier',
    'title'        => 'Monolog Prettifier',
    'description'  => [
        'de' => 'Human readable monolog log.<br>Please find it at Service -> Monolog Prettifier',
        'en' => 'Human readable monolog log.<br>Please find it at Service -> Monolog Prettifier',
    ],
    'thumbnail'    => 'logo.png',
    'version'      => '1.0.0',
    'author'       => 'Michael Keiluweit',
    'url'          => 'https://keiluweit.com',
    'email'        => 'michael.keiluweit@gmail.com',
    'controllers'  => [
        'mkemonologprettifier' => MichaelKeiluweit\MonologPrettifier\Controller\MonologPrettifier::class
    ],
    'templates' => [
        'list.tpl'  => 'mke/monolog-prettifier/views/tpl/list.tpl',
    ]
];
