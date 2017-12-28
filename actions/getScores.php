<?php
header("content-type:application/json");
header("Access-Control-Allow-Origin: *");
include_once "config.php";

/* 
Planetary Defense Engine v1.0.0
Last Updated: 2017-December-28
Author: William R.A.D. Funk - http://WilliamRobertFunk.com 
*/

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}
// Get top five scores
$sql = "SELECT * FROM Top_Scores ORDER BY score DESC LIMIT 6";
$result = $conn->query($sql);

$scores = '{"scores":[';
while ( $db_row = $result->fetch_array(MYSQLI_ASSOC) )
{
	$scores .= '{"initials":"' . $db_row['initials'] . '", "score":' . $db_row['score'] . '},';
}
$scores = rtrim($scores, ",");
$scores .= ']}';
print $scores;

$conn->close();
?>