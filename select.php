<?php
    $json_body = file_get_contents('php://input');
    $body = json_decode($json_body, true);
    $db_login = $body['databaseLogin'];
    $connection = new mysqli($db_login['serverName'], $db_login['username'], $db_login['password'], $db_login['databaseName']);
    if (!$connection->connect_error)
    {
        $sql = "SELECT ";
        if (array_key_exists('columns', $body))
        {
            $sql = $sql . "(";
            foreach ($body['columns'] as $column)
            {
                $sql = $sql . $column . ", ";
            }
            $sql = rtrim($sql, ", ");
            $sql = $sql . ")";
        }
        else
        {
            $sql = $sql . "*";
        }
        $sql = $sql . " FROM " . $body['tableName'];
        $query_result = $connection->query($sql);
        
        $row_count = $query_result->num_rows;
        
        $results_array = array();
        while ($row = $query_result->fetch_assoc())
        {
            $results_array[] = $row;
        }
        echo json_encode($results_array);
    }
    else
    {
        echo $connection->connect_error;
    }
    $connection->close();
?>
