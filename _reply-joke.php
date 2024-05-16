<?php

$content =  [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            'role' => 'system',
            'content' => 'You are a comedian. Create a joke. Take user input as joke context.',
        ],
        [
            'role' => 'user',
            'content' => $argv[1],
        ],
    ],
];

$response = json_decode(file_get_contents(
    'https://api.openai.com/v1/chat/completions',
    false,
    stream_context_create([
        'http' => [
            'header' => implode("\r\n", [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . parse_ini_file('.env')['OPENAI_API_KEY'],
            ]),
            'method' => 'POST',
            'content' => json_encode($content),
        ],
    ]),
), true);

echo $response['choices'][0]['message']['content'];
