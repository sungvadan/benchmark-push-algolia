<?php

require __DIR__ . '/vendor/autoload.php';
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$dotenv->load(__DIR__.'/.env');


$client = Algolia\AlgoliaSearch\SearchClient::create(
    $_ENV['API_ALGOLIA_KEY'],
    $_ENV['API_ALGOLIA_SECRET']
);

$indexName = 'staging_products';
$index = $client->initIndex($indexName);


$offset = 0;
$logs = $client->getLogs([
    'offset' => $offset,
    'length' => 1000,
    'type' => 'build'
]);

$result = [];
$nbCalls = 0;
$processingTimeMs = 0;
$nbOperation = 0;
while (!empty($logs['logs'])) {
    foreach ($logs['logs'] as $log) {
        if($log['index'] != $indexName) continue;
        $nbCalls++;
        $nbOperation +=  $log['nb_api_calls'];
        $processingTimeMs +=  $log['processing_time_ms'];
    }
    $offset += 1000;
    $logs = $client->getLogs([
        'offset' => $offset,
        'length' => 1000,
        'type' => 'build'
    ]);
}

echo 'moyenne de temps traitement par call ' . ($processingTimeMs/$nbCalls) .'<br/>';
echo 'moyenne de nombre d\'opération par call ' . ($nbOperation/$nbCalls) .'<br/>';