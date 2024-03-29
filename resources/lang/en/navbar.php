<?php

return [
    'header' => [
        'homepage' => [
            'title' => 'Homepage',
            'url' => route('home')
        ],
        'word_frequency' => [
            'title' => 'Word Frequency',
            'url' => route('wordFrequency.index')
        ],
        'flash_card' => [
            'title' =>  'Flash Cards',
            'url' => route('flashCard.index')
        ],
        'convert_multiple_choice' => [
            'title' => 'Convert Multiple Choice',
            'url' => route('convertMultipleChoice.index')
        ]
    ]
];
