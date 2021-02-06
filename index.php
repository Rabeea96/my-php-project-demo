<?php

// Loads environment variables from .env file to getenv()
require_once './DotEnv.php';
$dotenv = new DotEnv(__DIR__ . '/.env');
$dotenv->load();

// --------------------- Using the User class ---------------------
include './src/User.php';

$user = new User();

$arr = array(1,2,3,4,5);
$sum = $user->get_sum($arr);
echo 'The sum of the numbers (1,2,3,4,5) is: ' . $sum . '<br/><br/>';


// --------------------- Fetching data from a remote MySQL database ---------------------

$servername = getenv('DATABASE_SERVER');
$username = getenv('DATABASE_USER');
$password = getenv('DATABASE_PASSWORD');
$dbname = getenv('DATABASE_NAME');

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