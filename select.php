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
    $query_result = $connection->query($sql);

    $row_count = $query_result->num_rows;

    $results_array = array();
    while ($row = $query_result->fetch_assoc())
    {
        $results_array[] = $row;
    }
    $echo_result = array("rowCount" => $query_result->num_rows, "results" => $results_array)
    echo json_encode($echo_result);

    $connection->close();
?>
