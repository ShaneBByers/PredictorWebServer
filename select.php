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
    $sql = "SELECT * FROM " . $body['tableName'];
    $query_result = $connection->query($sql);

    $row_count = $query_result->num_rows;

    $results_array = array();
    while ($row = $query_result->fetch_assoc())
    {
        $results_array[] = $row;
    }
    $echo_result = array("filename" => "select.php",
                         "connectionStatus" => $connection_status,
                         "rowCount" => $query_result->num_rows,
                         "results" => $results_array);
    echo json_encode($echo_result);

    $connection->close();
?>
