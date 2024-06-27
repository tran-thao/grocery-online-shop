<?php
$connection = mysqli_connect('localhost', 'root', '', 'assignment1');

if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}

echo 'Connected successfully';

mysqli_close($connection);

