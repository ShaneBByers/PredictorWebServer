<?php
    echo "TEST.PHP", PHP_EOL;
    $json_body = file_get_contents('php://input');
    $body = json_decode($json_body, true)
    echo SERVER_NAME:, $body['ServerName'], PHP_EOL;
?>
