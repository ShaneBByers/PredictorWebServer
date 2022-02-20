<?php
    echo "TEST.PHP", PHP_EOL;
    $json_body = file_get_contents('php://input');
    $body = json_decode($json_body, true);
    $connection = new mysqli($body['serverName'], $body['username'], $body['password']);
    if ($connection->connect_error)
    {
        echo "Connection FAILED: ", $connection->connect_error, PHP_EOL;
    }
    echo "Connection SUCCEEDED", PHP_EOL;
?>
