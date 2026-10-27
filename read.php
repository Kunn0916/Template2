<?php
require('database.php');

$query = "SELECT * FROM students";
$sqlAccounts = mysqli_query($connection, $query);

if (!$sqlAccounts) {
    die("Query Failed: " . mysqli_error($connection));
}
?>