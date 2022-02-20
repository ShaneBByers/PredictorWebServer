<?php
    echo "select.php", PHP_EOL;
    $json_body = file_get_contents('php://input');
    $body = json_decode($json_body, true);
    $db_login = $body['databaseLogin'];
    $connection = new mysqli($db_login['serverName'], $db_login['username'], $db_login['password'], $db_login['databaseName']);
    if ($connection->connect_error)
    {
        echo "Connection FAILED: ", $connection->connect_error, PHP_EOL;
    }
    echo "Connection SUCCEEDED", PHP_EOL;
    $sql = "SELECT * FROM " . $body['tableName'];
    $result = $connection->query($sql);

    if ($result->num_rows > 0)
    {
        $results_array = array();
        while ($row = $result->fetch_assoc())
        {
            $results_array[] = $row
        }
        echo json_encode($results_array)
    }
    else
    {
        echo "NO RESULTS", PHP_EOL;
    }
    $connection->close();
?>
