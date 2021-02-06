<?php

// --------------------- Using the User class ---------------------
include './src/User.php';

$user = new User();

$arr = array(1,2,3,4,5);
$sum = $user->get_sum($arr);
echo 'The sum of the numbers (1,2,3,4,5) is: ' . $sum . '<br/><br/>';


// --------------------- Fetching data from a remote MySQL database ---------------------

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

  echo "<h1>Fetching data from remote MySQL</h1>";

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);

?> 