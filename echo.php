<?php
    echo "echo.php", PHP_EOL;
    $json_body = file_get_contents('php://input');
    echo $json_body, PHP_EOL;
?>
