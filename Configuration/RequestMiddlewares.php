<?php
return [
    'frontend' => [
        'html_compress' => [
            'target' => Pottkinder\Estimatedreading\Middleware\EstimateReading::class,
            'disabled' => false,
            'before' => [],
            'after' => [
                'typo3/cms-frontend/output-compression',
            ],
        ],
    ],
];