<?php

use gjbateup\NeoEloquent\Connection;
use Illuminate\Database\Capsule\Manager as Capsule;
use gjbateup\NeoEloquent\Schema\Grammars\CypherGrammar;

$connection = [
    'driver' => 'neo4j',
    'host'   => 'dev',
    'port'   => 7474,
    'username' => 'neo4j',
    'password' => 'neo4j'
];

gjbateup\NeoEloquent\Neo4j::connection($connection);

$capsule = new Capsule;
$manager = $capsule->getDatabaseManager();
$manager->extend('neo4j', function($config)
{
    $conn = new Connection($config);
    $conn->setSchemaGrammar(new CypherGrammar);
    return $conn;
});

$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();
