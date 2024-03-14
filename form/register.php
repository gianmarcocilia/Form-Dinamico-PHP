<?php

$fields = [
    'username' => [
        'attribute' => [
            'type' => 'text',
            'name' => 'username',
            'value' => '',
            'placeholder' => 'Inserisci il tuo Username'
        ],
        'rules' => [
            'required' => true,
            'min' => 2
        ],
        'errors' => []
    ],
    'email' => [
        'attribute' => [
            'type' => 'email',
            'name' => 'email',
            'value' => '',
            'placeholder' => 'Inserisci la tua Email'
        ],
        'rules' => [
            'required' => true,
            'email' => true
        ],
        'errors' => []
    ],
    'password' => [
        'attribute' => [
            'type' => 'password',
            'name' => 'password',
            'value' => '',
            'placeholder' => 'Inserisci la tua Password'
        ],
        'rules' => [
            'required' => true,
            'password' => 8
        ],
        'errors' => []
    ]
];

return [
    'formAttribute' => [
        'name' => 'register',
        'action' => 'index.php',
        'method' => 'post'
    ],
    'fields' => $fields,
    'status' => false
];
