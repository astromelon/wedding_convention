<?php

/**
 * Created by PhpStorm.
 * User: astromelon
 * Date: 2016-12-10
 * Time: 오후 7:46
 */
class MysqlConnector
{
    function db_connection()
    {
        $servername = "localhost";
        $username = "ssongu";
        $password = "ssongu52mysql";
        $dbname = "ssongu";


        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_errno);
        }

        return $conn;
    }

}