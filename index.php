<?php

echo '<h1>Hello world - updated2</h1>';

$servername = "sql7.freemysqlhosting.net";
$username = "sql7390181";
$password = "5fQWjdqkQz";
$dbname = "sql7390181";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

  echo "<h1>My PHP project - fetching data from remote MySQL</h1>";

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);

?> 