<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "chatroom";

// Connection
$conn = mysqli_connect($servername, $username, $password, $database);

// For checking if connection is successful or not
if (!$conn) {
    die("Connection failed: ". mysqli_connect_error());
}

?>