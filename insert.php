<?php
    $json_body = file_get_contents('php://input');
    $body = json_decode($json_body, true);
    $db_login = $body['databaseLogin'];
    $connection = new mysqli($db_login['serverName'], $db_login['username'], $db_login['password'], $db_login['databaseName']);
    if (!$connection->connect_error)
    {
        $connection_status = "SUCCESS";
    }
    else
    {
        $connection_status = "FAILED";
    }
    $sql = "INSERT INTO " . $body['tableName'] . " VALUES (10), (20), (30)";
    $query_result = $connection->query($sql);

    $row_count = $connection->affected_rows;

    $echo_result = array("filename" => "insert.php",
                         "connectionStatus" => $connection_status,
                         "rowCount" => $row_count,
                         "insertSuccess" => $query_result);
    echo json_encode($echo_result);

    $connection->close();
?>
