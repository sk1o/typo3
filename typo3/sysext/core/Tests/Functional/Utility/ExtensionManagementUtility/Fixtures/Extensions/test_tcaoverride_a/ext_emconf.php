<?php

declare(strict_types=1);

$EM_CONF[$_EXTKEY] = [
    'title' => 'Test TCA Override require in scoped environment (a)',
    'description' => 'Test TCA Override require in scoped environment (a)',
    'category' => 'example',
    'version' => '13.0.2',
    'state' => 'beta',
    'author' => 'Stefan Bürk',
    'author_email' => 'stefan@buerk.tech',
    'author_company' => '',
    'constraints' => [
        'depends' => [
            'typo3' => '13.0.2',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
