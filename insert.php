<?php
    $json_body = file_get_contents('php://input');
    $body = json_decode($json_body, true);
    $db_login = $body['databaseLogin'];
    $connection = new mysqli($db_login['serverName'], $db_login['username'], $db_login['password'], $db_login['databaseName']);
    if (!$connection->connect_error)
    {
        $sql = "INSERT INTO " . $body['tableName'] . " (";
        foreach ($body['columns'] as $column)
        {
            $sql = $sql . $column . ", ";
        }
        $sql = rtrim($sql, ", ");
        $sql = $sql . ") VALUES ";
        foreach ($body['values'] as $value)
        {
            $sql = $sql . "(";
            foreach ($body['columns'] as $column)
            {
                $sql = $sql . $value[$column] . ", ";
            }
            $sql = rtrim($sql, ", ");
            $sql = $sql . "), ";
        }
        $sql = rtrim($sql, ", ");
        
        $query_result = $connection->query($sql);
        
        echo json_encode($connection->affected_rows);
    }
    else
    {
        echo $connection->connect_error;
    }
    $connection->close();
?>
