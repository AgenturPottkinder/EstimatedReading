<?php

$EM_CONF[$_EXTKEY] = [
        'title' => 'Pottkinder: Estimated Reading',
        'description' => 'Counts words and sentences and calculates estimated reading for this.',
        'category' => 'services',
        'author' => 'Bastian Bringenberg',
        'author_email' => 'bastian@agentur-pottkinder.de',
        'author_company' => 'Agentur Pottkinder',
        'priority' => '',
        'module' => '',
        'state' => 'stable',
        'internal' => '',
        'uploadfolder' => false,
        'createDirs' => '',
        'clearCacheOnLoad' => 1,
        'version' => '1.0.0',
        'autoload' => [
            'psr-4' => [
                'Pottkinder\\Estimatedreading\\' => 'Classes',
            ],
        ],
        'constraints' => [
                'depends' => [
                        'typo3' => '8.7.99',
                ],
                'conflicts' => [],
                'suggests' => [],
        ]
];
