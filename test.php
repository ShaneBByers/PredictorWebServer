<?php
    echo "TEST.PHP", PHP_EOL;
    $entityBody = file_get_contents('php://input');
    echo $entityBody, PHP_EOL;
?>
