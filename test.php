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
    $sql = "SELECT TEST_COLUMN FROM TEST_TABLE";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            echo $row["TEST_COLUMN"], PHP_EOL;
        }
    }
    else
    {
        echo "NO RESULTS", PHP_EOL;
    }
    $connection->close();
?>
