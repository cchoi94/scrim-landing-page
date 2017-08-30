<?php

// Connecting to and selecting a MySQL database
// getenv uses the environment variables rather than checking in passwords
$mysqli = new mysqli('127.0.0.1', getenv('DB_USER'), getenv('DB_PASS'), 'landing-page');

// Bail out if there's connection issues
if ($mysqli->connect_errno) {
    // The connection failed.
    echo "error";
    // echo "Sorry, this website is experiencing problems.";

    // Debugging messages for the error
    // echo "Error: Failed to make a MySQL connection, here is why: \n";
    // echo "Errno: " . $mysqli->connect_errno . "\n";
    // echo "Error: " . $mysqli->connect_error . "\n";

    exit;
}

// Sanitize the input
$email = $mysqli->real_escape_string($_POST["email"]);

// Perform an SQL query
$sql = 'INSERT INTO contacts (email) VALUES ("'.$email.'")';

// Catch MySQL errors
if (!$result = $mysqli->query($sql)) {
    echo "Sorry, the website is experiencing problems.";

    // Debugging Messages
    //echo "Error: Our query failed to execute and here is why: \n";
    //echo "Query: " . $sql . "\n";
    //echo "Errno: " . $mysqli->errno . "\n";
    //echo "Error: " . $mysqli->error . "\n";
    exit;
}

// Confirm that our result was successful
if ($mysqli->affected_rows !== 1) {
    echo "error";
} else {
    echo "success";
}

$mysqli->close();

?>
