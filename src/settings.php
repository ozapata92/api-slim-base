<?php
return [
    'settings' => [
        'fortniteApiKey' => '20eac5a4-2284-4267-bcfc-96b30c9613a1',
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        "db" => [
            "host" => "localhost",
            "dbname" => "slim3",
            "user" => "root",
            "pass" => ""
        ],
        'secret' => 'gd345$FFdFsdf2',
        'json_dummy' => ' {
          "_id": "5aca43527281702f786ccbe8",
          "index": 0,
          "guid": "dd893976-f14f-4875-807c-215f78dba1ba",
          "isActive": true,
          "balance": "$3,807.33",
          "picture": "http://placehold.it/32x32",
          "age": 32,
          "eyeColor": "blue",
          "name": "Whitney Nicholson",
          "gender": "female",
          "company": "MEMORA",
          "email": "whitneynicholson@memora.com",
          "phone": "+1 (820) 408-3932",
          "address": "423 Highland Boulevard, Dawn, South Dakota, 4870",
          "about": "Et exercitation ad proident culpa. Sint nulla deserunt et ullamco aliqua ex. Do velit pariatur irure non.\r\n",
          "registered": "2018-04-02T02:01:14 -02:00",
          "latitude": 63.875573,
          "longitude": 163.652391,
          "tags": [
            "fugiat",
            "do",
            "nulla",
            "aliqua",
            "ex",
            "dolore",
            "labore"
          ],
          "friends": [{
              "id": 0,
              "name": "Chrystal Butler"
            },
            {
              "id": 1,
              "name": "Teresa Haley"
            },
            {
              "id": 2,
              "name": "Celeste Ortega"
            }
          ],
          "greeting": "Hello, Whitney Nicholson! You have 3 unread messages.",
          "favoriteFruit": "banana"
         }',
    ],
];